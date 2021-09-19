// Documentation Sidebar Toggle
jQuery('.js-docs-nav-toggle').on('click', function () {
    jQuery(this).toggleClass('is-active');
    jQuery(this).parent().parent().children('ul').slideToggle();
});

if (jQuery('.js-sidebar-simplebar')) {
    new SimpleBar(jQuery('.js-sidebar-simplebar')[0]);
}

// Keyboard Navigation
const knowpress_header = document.querySelector('.js-header');
const knowpress_search = document.querySelector('.js-header-search-wrapper');
const knowpress_searchBtn = knowpress_search.querySelector('.js-search-toggle');
const knowpress_searchFormBtn = knowpress_search.querySelector('.js-search-form-btn');
const KNOWLEDGE_KEYCODE_TAB = 9;
knowpress_search.addEventListener('keydown', function (e) {
    if (window.matchMedia("(max-width: 1024px)").matches && knowpress_header.classList.contains('is-search-open')) {
        if (e.key === 'Tab' || e.keyCode === KNOWLEDGE_KEYCODE_TAB) {
            if (e.shiftKey) /* shift + tab */ {
                if (document.activeElement === knowpress_searchBtn) {
                    knowpress_searchFormBtn.focus();
                    e.preventDefault();
                }
            } else /* tab */ {
                if (document.activeElement === knowpress_searchFormBtn) {
                    knowpress_searchBtn.focus();
                    e.preventDefault();
                }
            }
        }
    }
});


const knowpress_menuToggle = document.querySelector('.js-header-menu-toggle');
const knowpress_menu = document.querySelector('.js-primary-menu');
const knowpress_menuClose = document.querySelector('.js-sidebar-close');
const knowpress_menuLinks = knowpress_menu.getElementsByTagName('a');
const knowpress_menuListItems = knowpress_menu.querySelectorAll('li');

let knowpress_focus, knowpress_isToggleItem, knowpress_isBackward;
const knowpress_lastIndex = knowpress_menuListItems.length - 1;
const knowpress_lastParentIndex = document.querySelectorAll('.js-primary-menu > li').length - 1;
if (window.matchMedia("(max-width: 1024px)").matches) {
    document.addEventListener('focusin', function () {
        knowpress_focus = document.activeElement;
        if (knowpress_isToggleItem && knowpress_focus !== knowpress_menuLinks[0]) {
            document.querySelectorAll('.js-primary-menu > li')[knowpress_lastParentIndex].querySelector('a').focus();
        }

        if (knowpress_focus === knowpress_menuToggle) {
            knowpress_isToggleItem = true;
        } else {
            knowpress_isToggleItem = false;
        }
    }, true);

    document.addEventListener('keydown', function (e) {
        if (e.shiftKey && e.keyCode == 9) {
            knowpress_isBackward = true;
        } else {
            knowpress_isBackward = false;
        }
    });

    for (el of knowpress_menuLinks) {
        el.addEventListener('blur', function (e) {
            if (!knowpress_isBackward) {
                if (e.target === knowpress_menuLinks[knowpress_lastIndex]) {
                    knowpress_menuClose.focus();
                }
            }
        });
    }

    knowpress_menuClose.addEventListener('blur', function (e) {
        if (knowpress_isBackward) {
            knowpress_menuLinks[knowpress_lastIndex].focus();
        }
    });
}

jQuery('.js-header-menu-toggle').on('click', function () {
    if (jQuery('.js-header-menu-toggle').attr('aria-expanded') === 'true') {
        jQuery('.js-header-menu-toggle').attr('aria-expanded', 'false');
    } else {
        jQuery('.js-header-menu-toggle').attr('aria-expanded', 'true');

        setTimeout(function () {
            document.querySelector('.js-sidebar-close').focus();
        }, 400);
    }
    jQuery('.js-overlay').removeClass('is-hide');
    if (jQuery('body').hasClass('rtl')) {
        jQuery('.js-sidebar').animate({width: 'toggle', right: '0'});
    } else {
        jQuery('.js-sidebar').animate({width: 'toggle', left: '0'});
    }
});

jQuery('.js-sidebar-close').on('click', function () {
    if (jQuery('.js-header-menu-toggle').attr('aria-expanded') === 'true') {
        jQuery('.js-header-menu-toggle').attr('aria-expanded', 'false');
        knowpress_menuToggle.focus();
    } else {
        jQuery('.js-header-menu-toggle').attr('aria-expanded', 'true');
    }
    jQuery('.js-sidebar').animate({width: 'toggle', left: '-100%'});
    jQuery('.js-overlay').addClass('is-hide');
});

jQuery('.js-overlay').on('click', function () {
    if (jQuery('.js-header-menu-toggle').attr('aria-expanded') === 'true') {
        jQuery('.js-header-menu-toggle').attr('aria-expanded', 'false');
    } else {
        jQuery('.js-header-menu-toggle').attr('aria-expanded', 'true');
    }
    jQuery('.js-sidebar').animate({width: 'toggle', left: '-100%'});
    jQuery('.js-overlay').addClass('is-hide');
});

jQuery('.js-search-toggle').on('click', function () {
    jQuery(this).toggleClass('is-open');
    jQuery('.js-header-search-box').slideToggle('fast');
    jQuery('.js-header').toggleClass('is-search-open');
});

if (window.matchMedia("(max-width: 1024px)").matches) {
    jQuery('.js-branding').appendTo('.js-header-branding-wrapper');
    jQuery('.js-header-nav').appendTo('.js-sidebar .simplebar-content');
}

if (window.matchMedia("(min-width: 1024px)").matches) {
    jQuery('.js-branding').prependTo('.js-sidebar');
    jQuery('.js-header-nav').appendTo('.js-header-nav-wrapper');
}

jQuery(window).on('resize', function () {
    let win = jQuery(this); //this = window
    if (win.width() <= 1024) {
        jQuery('.js-branding').appendTo('.js-header-branding-wrapper');
        jQuery('.js-header-nav').appendTo('.js-sidebar .simplebar-content');
        jQuery('.js-sidebar').css('display', 'none');
        jQuery('.js-sidebar').css('left', '-10000');
    }
    if (win.width() >= 1024) {
        jQuery('.js-branding').prependTo('.js-sidebar');
        jQuery('.js-header-nav').appendTo('.js-header-nav-wrapper');
        jQuery('.js-sidebar').css('display', 'initial');
        jQuery('.js-sidebar').css('left', '0');
    }
});
