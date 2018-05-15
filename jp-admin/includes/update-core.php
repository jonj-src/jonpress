<?php
/**
 * JonPress core upgrade functionality.
 *
 * @package JonPress
 * @subpackage Administration
 * @since 2.7.0
 */

/**
 * Stores files to be deleted.
 *
 * @since 2.7.0
 * @global array $_old_files
 * @var array
 * @name $_old_files
 */
global $_old_files;

$_old_files = array(
	// 2.0
	'jp-admin/import-b2.php',
	'jp-admin/import-blogger.php',
	'jp-admin/import-greymatter.php',
	'jp-admin/import-livejournal.php',
	'jp-admin/import-mt.php',
	'jp-admin/import-rss.php',
	'jp-admin/import-textpattern.php',
	'jp-admin/quicktags.js',
	'jp-images/fade-butt.png',
	'jp-images/get-firefox.png',
	'jp-images/header-shadow.png',
	'jp-images/smilies',
	'jp-images/jp-small.png',
	'jp-images/wpminilogo.png',
	'wp.php',
	// 2.0.8
	'jp-includes/js/tinymce/plugins/inlinepopups/readme.txt',
	// 2.1
	'jp-admin/edit-form-ajax-cat.php',
	'jp-admin/execute-pings.php',
	'jp-admin/inline-uploading.php',
	'jp-admin/link-categories.php',
	'jp-admin/list-manipulation.js',
	'jp-admin/list-manipulation.php',
	'jp-includes/comment-functions.php',
	'jp-includes/feed-functions.php',
	'jp-includes/functions-compat.php',
	'jp-includes/functions-formatting.php',
	'jp-includes/functions-post.php',
	'jp-includes/js/dbx-key.js',
	'jp-includes/js/tinymce/plugins/autosave/langs/cs.js',
	'jp-includes/js/tinymce/plugins/autosave/langs/sv.js',
	'jp-includes/links.php',
	'jp-includes/pluggable-functions.php',
	'jp-includes/template-functions-author.php',
	'jp-includes/template-functions-category.php',
	'jp-includes/template-functions-general.php',
	'jp-includes/template-functions-links.php',
	'jp-includes/template-functions-post.php',
	'jp-includes/jp-l10n.php',
	// 2.2
	'jp-admin/cat-js.php',
	'jp-admin/import/b2.php',
	'jp-includes/js/autosave-js.php',
	'jp-includes/js/list-manipulation-js.php',
	'jp-includes/js/jp-ajax-js.php',
	// 2.3
	'jp-admin/admin-db.php',
	'jp-admin/cat.js',
	'jp-admin/categories.js',
	'jp-admin/custom-fields.js',
	'jp-admin/dbx-admin-key.js',
	'jp-admin/edit-comments.js',
	'jp-admin/install-rtl.css',
	'jp-admin/install.css',
	'jp-admin/upgrade-schema.php',
	'jp-admin/upload-functions.php',
	'jp-admin/upload-rtl.css',
	'jp-admin/upload.css',
	'jp-admin/upload.js',
	'jp-admin/users.js',
	'jp-admin/widgets-rtl.css',
	'jp-admin/widgets.css',
	'jp-admin/xfn.js',
	'jp-includes/js/tinymce/license.html',
	// 2.5
	'jp-admin/css/upload.css',
	'jp-admin/images/box-bg-left.gif',
	'jp-admin/images/box-bg-right.gif',
	'jp-admin/images/box-bg.gif',
	'jp-admin/images/box-butt-left.gif',
	'jp-admin/images/box-butt-right.gif',
	'jp-admin/images/box-butt.gif',
	'jp-admin/images/box-head-left.gif',
	'jp-admin/images/box-head-right.gif',
	'jp-admin/images/box-head.gif',
	'jp-admin/images/heading-bg.gif',
	'jp-admin/images/login-bkg-bottom.gif',
	'jp-admin/images/login-bkg-tile.gif',
	'jp-admin/images/notice.gif',
	'jp-admin/images/toggle.gif',
	'jp-admin/includes/upload.php',
	'jp-admin/js/dbx-admin-key.js',
	'jp-admin/js/link-cat.js',
	'jp-admin/profile-update.php',
	'jp-admin/templates.php',
	'jp-includes/images/wlw/WpComments.png',
	'jp-includes/images/wlw/WpIcon.png',
	'jp-includes/images/wlw/WpWatermark.png',
	'jp-includes/js/dbx.js',
	'jp-includes/js/fat.js',
	'jp-includes/js/list-manipulation.js',
	'jp-includes/js/tinymce/langs/en.js',
	'jp-includes/js/tinymce/plugins/autosave/editor_plugin_src.js',
	'jp-includes/js/tinymce/plugins/autosave/langs',
	'jp-includes/js/tinymce/plugins/directionality/images',
	'jp-includes/js/tinymce/plugins/directionality/langs',
	'jp-includes/js/tinymce/plugins/inlinepopups/css',
	'jp-includes/js/tinymce/plugins/inlinepopups/images',
	'jp-includes/js/tinymce/plugins/inlinepopups/jscripts',
	'jp-includes/js/tinymce/plugins/paste/images',
	'jp-includes/js/tinymce/plugins/paste/jscripts',
	'jp-includes/js/tinymce/plugins/paste/langs',
	'jp-includes/js/tinymce/plugins/spellchecker/classes/HttpClient.class.php',
	'jp-includes/js/tinymce/plugins/spellchecker/classes/TinyGoogleSpell.class.php',
	'jp-includes/js/tinymce/plugins/spellchecker/classes/TinyPspell.class.php',
	'jp-includes/js/tinymce/plugins/spellchecker/classes/TinyPspellShell.class.php',
	'jp-includes/js/tinymce/plugins/spellchecker/css/spellchecker.css',
	'jp-includes/js/tinymce/plugins/spellchecker/images',
	'jp-includes/js/tinymce/plugins/spellchecker/langs',
	'jp-includes/js/tinymce/plugins/spellchecker/tinyspell.php',
	'jp-includes/js/tinymce/plugins/jonpress/images',
	'jp-includes/js/tinymce/plugins/jonpress/langs',
	'jp-includes/js/tinymce/plugins/jonpress/jonpress.css',
	'jp-includes/js/tinymce/plugins/wphelp',
	'jp-includes/js/tinymce/themes/advanced/css',
	'jp-includes/js/tinymce/themes/advanced/images',
	'jp-includes/js/tinymce/themes/advanced/jscripts',
	'jp-includes/js/tinymce/themes/advanced/langs',
	// 2.5.1
	'jp-includes/js/tinymce/tiny_mce_gzip.php',
	// 2.6
	'jp-admin/bookmarklet.php',
	'jp-includes/js/jquery/jquery.dimensions.min.js',
	'jp-includes/js/tinymce/plugins/jonpress/popups.css',
	'jp-includes/js/jp-ajax.js',
	// 2.7
	'jp-admin/css/press-this-ie-rtl.css',
	'jp-admin/css/press-this-ie.css',
	'jp-admin/css/upload-rtl.css',
	'jp-admin/edit-form.php',
	'jp-admin/images/comment-pill.gif',
	'jp-admin/images/comment-stalk-classic.gif',
	'jp-admin/images/comment-stalk-fresh.gif',
	'jp-admin/images/comment-stalk-rtl.gif',
	'jp-admin/images/del.png',
	'jp-admin/images/gear.png',
	'jp-admin/images/media-button-gallery.gif',
	'jp-admin/images/media-buttons.gif',
	'jp-admin/images/postbox-bg.gif',
	'jp-admin/images/tab.png',
	'jp-admin/images/tail.gif',
	'jp-admin/js/forms.js',
	'jp-admin/js/upload.js',
	'jp-admin/link-import.php',
	'jp-includes/images/audio.png',
	'jp-includes/images/css.png',
	'jp-includes/images/default.png',
	'jp-includes/images/doc.png',
	'jp-includes/images/exe.png',
	'jp-includes/images/html.png',
	'jp-includes/images/js.png',
	'jp-includes/images/pdf.png',
	'jp-includes/images/swf.png',
	'jp-includes/images/tar.png',
	'jp-includes/images/text.png',
	'jp-includes/images/video.png',
	'jp-includes/images/zip.png',
	'jp-includes/js/tinymce/tiny_mce_config.php',
	'jp-includes/js/tinymce/tiny_mce_ext.js',
	// 2.8
	'jp-admin/js/users.js',
	'jp-includes/js/swfupload/plugins/swfupload.documentready.js',
	'jp-includes/js/swfupload/plugins/swfupload.graceful_degradation.js',
	'jp-includes/js/swfupload/swfupload_f9.swf',
	'jp-includes/js/tinymce/plugins/autosave',
	'jp-includes/js/tinymce/plugins/paste/css',
	'jp-includes/js/tinymce/utils/mclayer.js',
	'jp-includes/js/tinymce/jonpress.css',
	// 2.8.5
	'jp-admin/import/btt.php',
	'jp-admin/import/jkw.php',
	// 2.9
	'jp-admin/js/page.dev.js',
	'jp-admin/js/page.js',
	'jp-admin/js/set-post-thumbnail-handler.dev.js',
	'jp-admin/js/set-post-thumbnail-handler.js',
	'jp-admin/js/slug.dev.js',
	'jp-admin/js/slug.js',
	'jp-includes/gettext.php',
	'jp-includes/js/tinymce/plugins/jonpress/js',
	'jp-includes/streams.php',
	// MU
	'README.txt',
	'htaccess.dist',
	'index-install.php',
	'jp-admin/css/mu-rtl.css',
	'jp-admin/css/mu.css',
	'jp-admin/images/site-admin.png',
	'jp-admin/includes/mu.php',
	'jp-admin/wpmu-admin.php',
	'jp-admin/wpmu-blogs.php',
	'jp-admin/wpmu-edit.php',
	'jp-admin/wpmu-options.php',
	'jp-admin/wpmu-themes.php',
	'jp-admin/wpmu-upgrade-site.php',
	'jp-admin/wpmu-users.php',
	'jp-includes/images/jonpress-mu.png',
	'jp-includes/wpmu-default-filters.php',
	'jp-includes/wpmu-functions.php',
	'wpmu-settings.php',
	// 3.0
	'jp-admin/categories.php',
	'jp-admin/edit-category-form.php',
	'jp-admin/edit-page-form.php',
	'jp-admin/edit-pages.php',
	'jp-admin/images/admin-header-footer.png',
	'jp-admin/images/browse-happy.gif',
	'jp-admin/images/ico-add.png',
	'jp-admin/images/ico-close.png',
	'jp-admin/images/ico-edit.png',
	'jp-admin/images/ico-viewpage.png',
	'jp-admin/images/fav-top.png',
	'jp-admin/images/screen-options-left.gif',
	'jp-admin/images/jp-logo-vs.gif',
	'jp-admin/images/jp-logo.gif',
	'jp-admin/import',
	'jp-admin/js/jp-gears.dev.js',
	'jp-admin/js/jp-gears.js',
	'jp-admin/options-misc.php',
	'jp-admin/page-new.php',
	'jp-admin/page.php',
	'jp-admin/rtl.css',
	'jp-admin/rtl.dev.css',
	'jp-admin/update-links.php',
	'jp-admin/jp-admin.css',
	'jp-admin/jp-admin.dev.css',
	'jp-includes/js/codepress',
	'jp-includes/js/codepress/engines/khtml.js',
	'jp-includes/js/codepress/engines/older.js',
	'jp-includes/js/jquery/autocomplete.dev.js',
	'jp-includes/js/jquery/autocomplete.js',
	'jp-includes/js/jquery/interface.js',
	'jp-includes/js/scriptaculous/prototype.js',
	'jp-includes/js/tinymce/jp-tinymce.js',
	// 3.1
	'jp-admin/edit-attachment-rows.php',
	'jp-admin/edit-link-categories.php',
	'jp-admin/edit-link-category-form.php',
	'jp-admin/edit-post-rows.php',
	'jp-admin/images/button-grad-active-vs.png',
	'jp-admin/images/button-grad-vs.png',
	'jp-admin/images/fav-arrow-vs-rtl.gif',
	'jp-admin/images/fav-arrow-vs.gif',
	'jp-admin/images/fav-top-vs.gif',
	'jp-admin/images/list-vs.png',
	'jp-admin/images/screen-options-right-up.gif',
	'jp-admin/images/screen-options-right.gif',
	'jp-admin/images/visit-site-button-grad-vs.gif',
	'jp-admin/images/visit-site-button-grad.gif',
	'jp-admin/link-category.php',
	'jp-admin/sidebar.php',
	'jp-includes/classes.php',
	'jp-includes/js/tinymce/blank.htm',
	'jp-includes/js/tinymce/plugins/media/css/content.css',
	'jp-includes/js/tinymce/plugins/media/img',
	'jp-includes/js/tinymce/plugins/safari',
	// 3.2
	'jp-admin/images/logo-login.gif',
	'jp-admin/images/star.gif',
	'jp-admin/js/list-table.dev.js',
	'jp-admin/js/list-table.js',
	'jp-includes/default-embeds.php',
	'jp-includes/js/tinymce/plugins/jonpress/img/help.gif',
	'jp-includes/js/tinymce/plugins/jonpress/img/more.gif',
	'jp-includes/js/tinymce/plugins/jonpress/img/toolbars.gif',
	'jp-includes/js/tinymce/themes/advanced/img/fm.gif',
	'jp-includes/js/tinymce/themes/advanced/img/sflogo.png',
	// 3.3
	'jp-admin/css/colors-classic-rtl.css',
	'jp-admin/css/colors-classic-rtl.dev.css',
	'jp-admin/css/colors-fresh-rtl.css',
	'jp-admin/css/colors-fresh-rtl.dev.css',
	'jp-admin/css/dashboard-rtl.dev.css',
	'jp-admin/css/dashboard.dev.css',
	'jp-admin/css/global-rtl.css',
	'jp-admin/css/global-rtl.dev.css',
	'jp-admin/css/global.css',
	'jp-admin/css/global.dev.css',
	'jp-admin/css/install-rtl.dev.css',
	'jp-admin/css/login-rtl.dev.css',
	'jp-admin/css/login.dev.css',
	'jp-admin/css/ms.css',
	'jp-admin/css/ms.dev.css',
	'jp-admin/css/nav-menu-rtl.css',
	'jp-admin/css/nav-menu-rtl.dev.css',
	'jp-admin/css/nav-menu.css',
	'jp-admin/css/nav-menu.dev.css',
	'jp-admin/css/plugin-install-rtl.css',
	'jp-admin/css/plugin-install-rtl.dev.css',
	'jp-admin/css/plugin-install.css',
	'jp-admin/css/plugin-install.dev.css',
	'jp-admin/css/press-this-rtl.dev.css',
	'jp-admin/css/press-this.dev.css',
	'jp-admin/css/theme-editor-rtl.css',
	'jp-admin/css/theme-editor-rtl.dev.css',
	'jp-admin/css/theme-editor.css',
	'jp-admin/css/theme-editor.dev.css',
	'jp-admin/css/theme-install-rtl.css',
	'jp-admin/css/theme-install-rtl.dev.css',
	'jp-admin/css/theme-install.css',
	'jp-admin/css/theme-install.dev.css',
	'jp-admin/css/widgets-rtl.dev.css',
	'jp-admin/css/widgets.dev.css',
	'jp-admin/includes/internal-linking.php',
	'jp-includes/images/admin-bar-sprite-rtl.png',
	'jp-includes/js/jquery/ui.button.js',
	'jp-includes/js/jquery/ui.core.js',
	'jp-includes/js/jquery/ui.dialog.js',
	'jp-includes/js/jquery/ui.draggable.js',
	'jp-includes/js/jquery/ui.droppable.js',
	'jp-includes/js/jquery/ui.mouse.js',
	'jp-includes/js/jquery/ui.position.js',
	'jp-includes/js/jquery/ui.resizable.js',
	'jp-includes/js/jquery/ui.selectable.js',
	'jp-includes/js/jquery/ui.sortable.js',
	'jp-includes/js/jquery/ui.tabs.js',
	'jp-includes/js/jquery/ui.widget.js',
	'jp-includes/js/l10n.dev.js',
	'jp-includes/js/l10n.js',
	'jp-includes/js/tinymce/plugins/wplink/css',
	'jp-includes/js/tinymce/plugins/wplink/img',
	'jp-includes/js/tinymce/plugins/wplink/js',
	'jp-includes/js/tinymce/themes/advanced/img/wpicons.png',
	'jp-includes/js/tinymce/themes/advanced/skins/jp_theme/img/butt2.png',
	'jp-includes/js/tinymce/themes/advanced/skins/jp_theme/img/button_bg.png',
	'jp-includes/js/tinymce/themes/advanced/skins/jp_theme/img/down_arrow.gif',
	'jp-includes/js/tinymce/themes/advanced/skins/jp_theme/img/fade-butt.png',
	'jp-includes/js/tinymce/themes/advanced/skins/jp_theme/img/separator.gif',
	// Don't delete, yet: 'jp-rss.php',
	// Don't delete, yet: 'jp-rdf.php',
	// Don't delete, yet: 'jp-rss2.php',
	// Don't delete, yet: 'jp-commentsrss2.php',
	// Don't delete, yet: 'jp-atom.php',
	// Don't delete, yet: 'jp-feed.php',
	// 3.4
	'jp-admin/images/gray-star.png',
	'jp-admin/images/logo-login.png',
	'jp-admin/images/star.png',
	'jp-admin/index-extra.php',
	'jp-admin/network/index-extra.php',
	'jp-admin/user/index-extra.php',
	'jp-admin/images/screenshots/admin-flyouts.png',
	'jp-admin/images/screenshots/coediting.png',
	'jp-admin/images/screenshots/drag-and-drop.png',
	'jp-admin/images/screenshots/help-screen.png',
	'jp-admin/images/screenshots/media-icon.png',
	'jp-admin/images/screenshots/new-feature-pointer.png',
	'jp-admin/images/screenshots/welcome-screen.png',
	'jp-includes/css/editor-buttons.css',
	'jp-includes/css/editor-buttons.dev.css',
	'jp-includes/js/tinymce/plugins/paste/blank.htm',
	'jp-includes/js/tinymce/plugins/jonpress/css',
	'jp-includes/js/tinymce/plugins/jonpress/editor_plugin.dev.js',
	'jp-includes/js/tinymce/plugins/jonpress/img/embedded.png',
	'jp-includes/js/tinymce/plugins/jonpress/img/more_bug.gif',
	'jp-includes/js/tinymce/plugins/jonpress/img/page_bug.gif',
	'jp-includes/js/tinymce/plugins/wpdialogs/editor_plugin.dev.js',
	'jp-includes/js/tinymce/plugins/wpeditimage/css/editimage-rtl.css',
	'jp-includes/js/tinymce/plugins/wpeditimage/editor_plugin.dev.js',
	'jp-includes/js/tinymce/plugins/wpfullscreen/editor_plugin.dev.js',
	'jp-includes/js/tinymce/plugins/wpgallery/editor_plugin.dev.js',
	'jp-includes/js/tinymce/plugins/wpgallery/img/gallery.png',
	'jp-includes/js/tinymce/plugins/wplink/editor_plugin.dev.js',
	// Don't delete, yet: 'jp-pass.php',
	// Don't delete, yet: 'jp-register.php',
	// 3.5
	'jp-admin/gears-manifest.php',
	'jp-admin/includes/manifest.php',
	'jp-admin/images/archive-link.png',
	'jp-admin/images/blue-grad.png',
	'jp-admin/images/button-grad-active.png',
	'jp-admin/images/button-grad.png',
	'jp-admin/images/ed-bg-vs.gif',
	'jp-admin/images/ed-bg.gif',
	'jp-admin/images/fade-butt.png',
	'jp-admin/images/fav-arrow-rtl.gif',
	'jp-admin/images/fav-arrow.gif',
	'jp-admin/images/fav-vs.png',
	'jp-admin/images/fav.png',
	'jp-admin/images/gray-grad.png',
	'jp-admin/images/loading-publish.gif',
	'jp-admin/images/logo-ghost.png',
	'jp-admin/images/logo.gif',
	'jp-admin/images/menu-arrow-frame-rtl.png',
	'jp-admin/images/menu-arrow-frame.png',
	'jp-admin/images/menu-arrows.gif',
	'jp-admin/images/menu-bits-rtl-vs.gif',
	'jp-admin/images/menu-bits-rtl.gif',
	'jp-admin/images/menu-bits-vs.gif',
	'jp-admin/images/menu-bits.gif',
	'jp-admin/images/menu-dark-rtl-vs.gif',
	'jp-admin/images/menu-dark-rtl.gif',
	'jp-admin/images/menu-dark-vs.gif',
	'jp-admin/images/menu-dark.gif',
	'jp-admin/images/required.gif',
	'jp-admin/images/screen-options-toggle-vs.gif',
	'jp-admin/images/screen-options-toggle.gif',
	'jp-admin/images/toggle-arrow-rtl.gif',
	'jp-admin/images/toggle-arrow.gif',
	'jp-admin/images/upload-classic.png',
	'jp-admin/images/upload-fresh.png',
	'jp-admin/images/white-grad-active.png',
	'jp-admin/images/white-grad.png',
	'jp-admin/images/widgets-arrow-vs.gif',
	'jp-admin/images/widgets-arrow.gif',
	'jp-admin/images/wpspin_dark.gif',
	'jp-includes/images/upload.png',
	'jp-includes/js/prototype.js',
	'jp-includes/js/scriptaculous',
	'jp-admin/css/jp-admin-rtl.dev.css',
	'jp-admin/css/jp-admin.dev.css',
	'jp-admin/css/media-rtl.dev.css',
	'jp-admin/css/media.dev.css',
	'jp-admin/css/colors-classic.dev.css',
	'jp-admin/css/customize-controls-rtl.dev.css',
	'jp-admin/css/customize-controls.dev.css',
	'jp-admin/css/ie-rtl.dev.css',
	'jp-admin/css/ie.dev.css',
	'jp-admin/css/install.dev.css',
	'jp-admin/css/colors-fresh.dev.css',
	'jp-includes/js/customize-base.dev.js',
	'jp-includes/js/json2.dev.js',
	'jp-includes/js/comment-reply.dev.js',
	'jp-includes/js/customize-preview.dev.js',
	'jp-includes/js/wplink.dev.js',
	'jp-includes/js/tw-sack.dev.js',
	'jp-includes/js/jp-list-revisions.dev.js',
	'jp-includes/js/autosave.dev.js',
	'jp-includes/js/admin-bar.dev.js',
	'jp-includes/js/quicktags.dev.js',
	'jp-includes/js/jp-ajax-response.dev.js',
	'jp-includes/js/jp-pointer.dev.js',
	'jp-includes/js/hoverIntent.dev.js',
	'jp-includes/js/colorpicker.dev.js',
	'jp-includes/js/jp-lists.dev.js',
	'jp-includes/js/customize-loader.dev.js',
	'jp-includes/js/jquery/jquery.table-hotkeys.dev.js',
	'jp-includes/js/jquery/jquery.color.dev.js',
	'jp-includes/js/jquery/jquery.color.js',
	'jp-includes/js/jquery/jquery.hotkeys.dev.js',
	'jp-includes/js/jquery/jquery.form.dev.js',
	'jp-includes/js/jquery/suggest.dev.js',
	'jp-admin/js/xfn.dev.js',
	'jp-admin/js/set-post-thumbnail.dev.js',
	'jp-admin/js/comment.dev.js',
	'jp-admin/js/theme.dev.js',
	'jp-admin/js/cat.dev.js',
	'jp-admin/js/password-strength-meter.dev.js',
	'jp-admin/js/user-profile.dev.js',
	'jp-admin/js/theme-preview.dev.js',
	'jp-admin/js/post.dev.js',
	'jp-admin/js/media-upload.dev.js',
	'jp-admin/js/word-count.dev.js',
	'jp-admin/js/plugin-install.dev.js',
	'jp-admin/js/edit-comments.dev.js',
	'jp-admin/js/media-gallery.dev.js',
	'jp-admin/js/custom-fields.dev.js',
	'jp-admin/js/custom-background.dev.js',
	'jp-admin/js/common.dev.js',
	'jp-admin/js/inline-edit-tax.dev.js',
	'jp-admin/js/gallery.dev.js',
	'jp-admin/js/utils.dev.js',
	'jp-admin/js/widgets.dev.js',
	'jp-admin/js/jp-fullscreen.dev.js',
	'jp-admin/js/nav-menu.dev.js',
	'jp-admin/js/dashboard.dev.js',
	'jp-admin/js/link.dev.js',
	'jp-admin/js/user-suggest.dev.js',
	'jp-admin/js/postbox.dev.js',
	'jp-admin/js/tags.dev.js',
	'jp-admin/js/image-edit.dev.js',
	'jp-admin/js/media.dev.js',
	'jp-admin/js/customize-controls.dev.js',
	'jp-admin/js/inline-edit-post.dev.js',
	'jp-admin/js/categories.dev.js',
	'jp-admin/js/editor.dev.js',
	'jp-includes/js/tinymce/plugins/wpeditimage/js/editimage.dev.js',
	'jp-includes/js/tinymce/plugins/wpdialogs/js/popup.dev.js',
	'jp-includes/js/tinymce/plugins/wpdialogs/js/wpdialog.dev.js',
	'jp-includes/js/plupload/handlers.dev.js',
	'jp-includes/js/plupload/jp-plupload.dev.js',
	'jp-includes/js/swfupload/handlers.dev.js',
	'jp-includes/js/jcrop/jquery.Jcrop.dev.js',
	'jp-includes/js/jcrop/jquery.Jcrop.js',
	'jp-includes/js/jcrop/jquery.Jcrop.css',
	'jp-includes/js/imgareaselect/jquery.imgareaselect.dev.js',
	'jp-includes/css/jp-pointer.dev.css',
	'jp-includes/css/editor.dev.css',
	'jp-includes/css/jquery-ui-dialog.dev.css',
	'jp-includes/css/admin-bar-rtl.dev.css',
	'jp-includes/css/admin-bar.dev.css',
	'jp-includes/js/jquery/ui/jquery.effects.clip.min.js',
	'jp-includes/js/jquery/ui/jquery.effects.scale.min.js',
	'jp-includes/js/jquery/ui/jquery.effects.blind.min.js',
	'jp-includes/js/jquery/ui/jquery.effects.core.min.js',
	'jp-includes/js/jquery/ui/jquery.effects.shake.min.js',
	'jp-includes/js/jquery/ui/jquery.effects.fade.min.js',
	'jp-includes/js/jquery/ui/jquery.effects.explode.min.js',
	'jp-includes/js/jquery/ui/jquery.effects.slide.min.js',
	'jp-includes/js/jquery/ui/jquery.effects.drop.min.js',
	'jp-includes/js/jquery/ui/jquery.effects.highlight.min.js',
	'jp-includes/js/jquery/ui/jquery.effects.bounce.min.js',
	'jp-includes/js/jquery/ui/jquery.effects.pulsate.min.js',
	'jp-includes/js/jquery/ui/jquery.effects.transfer.min.js',
	'jp-includes/js/jquery/ui/jquery.effects.fold.min.js',
	'jp-admin/images/screenshots/captions-1.png',
	'jp-admin/images/screenshots/captions-2.png',
	'jp-admin/images/screenshots/flex-header-1.png',
	'jp-admin/images/screenshots/flex-header-2.png',
	'jp-admin/images/screenshots/flex-header-3.png',
	'jp-admin/images/screenshots/flex-header-media-library.png',
	'jp-admin/images/screenshots/theme-customizer.png',
	'jp-admin/images/screenshots/twitter-embed-1.png',
	'jp-admin/images/screenshots/twitter-embed-2.png',
	'jp-admin/js/utils.js',
	'jp-admin/options-privacy.php',
	'jp-app.php',
	'jp-includes/class-jp-atom-server.php',
	'jp-includes/js/tinymce/themes/advanced/skins/jp_theme/ui.css',
	// 3.5.2
	'jp-includes/js/swfupload/swfupload-all.js',
	// 3.6
	'jp-admin/js/revisions-js.php',
	'jp-admin/images/screenshots',
	'jp-admin/js/categories.js',
	'jp-admin/js/categories.min.js',
	'jp-admin/js/custom-fields.js',
	'jp-admin/js/custom-fields.min.js',
	// 3.7
	'jp-admin/js/cat.js',
	'jp-admin/js/cat.min.js',
	'jp-includes/js/tinymce/plugins/wpeditimage/js/editimage.min.js',
	// 3.8
	'jp-includes/js/tinymce/themes/advanced/skins/jp_theme/img/page_bug.gif',
	'jp-includes/js/tinymce/themes/advanced/skins/jp_theme/img/more_bug.gif',
	'jp-includes/js/thickbox/tb-close-2x.png',
	'jp-includes/js/thickbox/tb-close.png',
	'jp-includes/images/wpmini-blue-2x.png',
	'jp-includes/images/wpmini-blue.png',
	'jp-admin/css/colors-fresh.css',
	'jp-admin/css/colors-classic.css',
	'jp-admin/css/colors-fresh.min.css',
	'jp-admin/css/colors-classic.min.css',
	'jp-admin/js/about.min.js',
	'jp-admin/js/about.js',
	'jp-admin/images/arrows-dark-vs-2x.png',
	'jp-admin/images/jp-logo-vs.png',
	'jp-admin/images/arrows-dark-vs.png',
	'jp-admin/images/jp-logo.png',
	'jp-admin/images/arrows-pr.png',
	'jp-admin/images/arrows-dark.png',
	'jp-admin/images/press-this.png',
	'jp-admin/images/press-this-2x.png',
	'jp-admin/images/arrows-vs-2x.png',
	'jp-admin/images/welcome-icons.png',
	'jp-admin/images/jp-logo-2x.png',
	'jp-admin/images/stars-rtl-2x.png',
	'jp-admin/images/arrows-dark-2x.png',
	'jp-admin/images/arrows-pr-2x.png',
	'jp-admin/images/menu-shadow-rtl.png',
	'jp-admin/images/arrows-vs.png',
	'jp-admin/images/about-search-2x.png',
	'jp-admin/images/bubble_bg-rtl-2x.gif',
	'jp-admin/images/jp-badge-2x.png',
	'jp-admin/images/jonpress-logo-2x.png',
	'jp-admin/images/bubble_bg-rtl.gif',
	'jp-admin/images/jp-badge.png',
	'jp-admin/images/menu-shadow.png',
	'jp-admin/images/about-globe-2x.png',
	'jp-admin/images/welcome-icons-2x.png',
	'jp-admin/images/stars-rtl.png',
	'jp-admin/images/jp-logo-vs-2x.png',
	'jp-admin/images/about-updates-2x.png',
	// 3.9
	'jp-admin/css/colors.css',
	'jp-admin/css/colors.min.css',
	'jp-admin/css/colors-rtl.css',
	'jp-admin/css/colors-rtl.min.css',
	// Following files added back in 4.5 see #36083
	// 'jp-admin/css/media-rtl.min.css',
	// 'jp-admin/css/media.min.css',
	// 'jp-admin/css/farbtastic-rtl.min.css',
	'jp-admin/images/lock-2x.png',
	'jp-admin/images/lock.png',
	'jp-admin/js/theme-preview.js',
	'jp-admin/js/theme-install.min.js',
	'jp-admin/js/theme-install.js',
	'jp-admin/js/theme-preview.min.js',
	'jp-includes/js/plupload/plupload.html4.js',
	'jp-includes/js/plupload/plupload.html5.js',
	'jp-includes/js/plupload/changelog.txt',
	'jp-includes/js/plupload/plupload.silverlight.js',
	'jp-includes/js/plupload/plupload.flash.js',
	// Added back in 4.9 [41328], see #41755
	// 'jp-includes/js/plupload/plupload.js',
	'jp-includes/js/tinymce/plugins/spellchecker',
	'jp-includes/js/tinymce/plugins/inlinepopups',
	'jp-includes/js/tinymce/plugins/media/js',
	'jp-includes/js/tinymce/plugins/media/css',
	'jp-includes/js/tinymce/plugins/jonpress/img',
	'jp-includes/js/tinymce/plugins/wpdialogs/js',
	'jp-includes/js/tinymce/plugins/wpeditimage/img',
	'jp-includes/js/tinymce/plugins/wpeditimage/js',
	'jp-includes/js/tinymce/plugins/wpeditimage/css',
	'jp-includes/js/tinymce/plugins/wpgallery/img',
	'jp-includes/js/tinymce/plugins/wpfullscreen/css',
	'jp-includes/js/tinymce/plugins/paste/js',
	'jp-includes/js/tinymce/themes/advanced',
	'jp-includes/js/tinymce/tiny_mce.js',
	'jp-includes/js/tinymce/mark_loaded_src.js',
	'jp-includes/js/tinymce/jp-tinymce-schema.js',
	'jp-includes/js/tinymce/plugins/media/editor_plugin.js',
	'jp-includes/js/tinymce/plugins/media/editor_plugin_src.js',
	'jp-includes/js/tinymce/plugins/media/media.htm',
	'jp-includes/js/tinymce/plugins/wpview/editor_plugin_src.js',
	'jp-includes/js/tinymce/plugins/wpview/editor_plugin.js',
	'jp-includes/js/tinymce/plugins/directionality/editor_plugin.js',
	'jp-includes/js/tinymce/plugins/directionality/editor_plugin_src.js',
	'jp-includes/js/tinymce/plugins/jonpress/editor_plugin.js',
	'jp-includes/js/tinymce/plugins/jonpress/editor_plugin_src.js',
	'jp-includes/js/tinymce/plugins/wpdialogs/editor_plugin_src.js',
	'jp-includes/js/tinymce/plugins/wpdialogs/editor_plugin.js',
	'jp-includes/js/tinymce/plugins/wpeditimage/editimage.html',
	'jp-includes/js/tinymce/plugins/wpeditimage/editor_plugin.js',
	'jp-includes/js/tinymce/plugins/wpeditimage/editor_plugin_src.js',
	'jp-includes/js/tinymce/plugins/fullscreen/editor_plugin_src.js',
	'jp-includes/js/tinymce/plugins/fullscreen/fullscreen.htm',
	'jp-includes/js/tinymce/plugins/fullscreen/editor_plugin.js',
	'jp-includes/js/tinymce/plugins/wplink/editor_plugin_src.js',
	'jp-includes/js/tinymce/plugins/wplink/editor_plugin.js',
	'jp-includes/js/tinymce/plugins/wpgallery/editor_plugin_src.js',
	'jp-includes/js/tinymce/plugins/wpgallery/editor_plugin.js',
	'jp-includes/js/tinymce/plugins/tabfocus/editor_plugin.js',
	'jp-includes/js/tinymce/plugins/tabfocus/editor_plugin_src.js',
	'jp-includes/js/tinymce/plugins/wpfullscreen/editor_plugin.js',
	'jp-includes/js/tinymce/plugins/wpfullscreen/editor_plugin_src.js',
	'jp-includes/js/tinymce/plugins/paste/editor_plugin.js',
	'jp-includes/js/tinymce/plugins/paste/pasteword.htm',
	'jp-includes/js/tinymce/plugins/paste/editor_plugin_src.js',
	'jp-includes/js/tinymce/plugins/paste/pastetext.htm',
	'jp-includes/js/tinymce/langs/jp-langs.php',
	// 4.1
	'jp-includes/js/jquery/ui/jquery.ui.accordion.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.autocomplete.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.button.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.core.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.datepicker.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.dialog.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.draggable.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.droppable.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.effect-blind.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.effect-bounce.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.effect-clip.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.effect-drop.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.effect-explode.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.effect-fade.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.effect-fold.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.effect-highlight.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.effect-pulsate.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.effect-scale.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.effect-shake.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.effect-slide.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.effect-transfer.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.effect.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.menu.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.mouse.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.position.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.progressbar.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.resizable.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.selectable.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.slider.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.sortable.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.spinner.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.tabs.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.tooltip.min.js',
	'jp-includes/js/jquery/ui/jquery.ui.widget.min.js',
	'jp-includes/js/tinymce/skins/jonpress/images/dashicon-no-alt.png',
	// 4.3
	'jp-admin/js/jp-fullscreen.js',
	'jp-admin/js/jp-fullscreen.min.js',
	'jp-includes/js/tinymce/jp-mce-help.php',
	'jp-includes/js/tinymce/plugins/wpfullscreen',
	// 4.5
	'jp-includes/theme-compat/comments-popup.php',
	// 4.6
	'jp-admin/includes/class-jp-automatic-upgrader.php', // Wrong file name, see #37628.
	// 4.8
	'jp-includes/js/tinymce/plugins/wpembed',
	'jp-includes/js/tinymce/plugins/media/moxieplayer.swf',
	'jp-includes/js/tinymce/skins/lightgray/fonts/readme.md',
	'jp-includes/js/tinymce/skins/lightgray/fonts/tinymce-small.json',
	'jp-includes/js/tinymce/skins/lightgray/fonts/tinymce.json',
	'jp-includes/js/tinymce/skins/lightgray/skin.ie7.min.css',
	// 4.9
	'jp-admin/css/press-this-editor-rtl.css',
	'jp-admin/css/press-this-editor-rtl.min.css',
	'jp-admin/css/press-this-editor.css',
	'jp-admin/css/press-this-editor.min.css',
	'jp-admin/css/press-this-rtl.css',
	'jp-admin/css/press-this-rtl.min.css',
	'jp-admin/css/press-this.css',
	'jp-admin/css/press-this.min.css',
	'jp-admin/includes/class-jp-press-this.php',
	'jp-admin/js/bookmarklet.js',
	'jp-admin/js/bookmarklet.min.js',
	'jp-admin/js/press-this.js',
	'jp-admin/js/press-this.min.js',
	'jp-includes/js/mediaelement/background.png',
	'jp-includes/js/mediaelement/bigplay.png',
	'jp-includes/js/mediaelement/bigplay.svg',
	'jp-includes/js/mediaelement/controls.png',
	'jp-includes/js/mediaelement/controls.svg',
	'jp-includes/js/mediaelement/flashmediaelement.swf',
	'jp-includes/js/mediaelement/froogaloop.min.js',
	'jp-includes/js/mediaelement/jumpforward.png',
	'jp-includes/js/mediaelement/loading.gif',
	'jp-includes/js/mediaelement/silverlightmediaelement.xap',
	'jp-includes/js/mediaelement/skipback.png',
	'jp-includes/js/plupload/plupload.flash.swf',
	'jp-includes/js/plupload/plupload.full.min.js',
	'jp-includes/js/plupload/plupload.silverlight.xap',
	'jp-includes/js/swfupload/plugins',
	'jp-includes/js/swfupload/swfupload.swf',
	// 4.9.2
	'jp-includes/js/mediaelement/lang',
	'jp-includes/js/mediaelement/lang/ca.js',
	'jp-includes/js/mediaelement/lang/cs.js',
	'jp-includes/js/mediaelement/lang/de.js',
	'jp-includes/js/mediaelement/lang/es.js',
	'jp-includes/js/mediaelement/lang/fa.js',
	'jp-includes/js/mediaelement/lang/fr.js',
	'jp-includes/js/mediaelement/lang/hr.js',
	'jp-includes/js/mediaelement/lang/hu.js',
	'jp-includes/js/mediaelement/lang/it.js',
	'jp-includes/js/mediaelement/lang/ja.js',
	'jp-includes/js/mediaelement/lang/ko.js',
	'jp-includes/js/mediaelement/lang/nl.js',
	'jp-includes/js/mediaelement/lang/pl.js',
	'jp-includes/js/mediaelement/lang/pt.js',
	'jp-includes/js/mediaelement/lang/ro.js',
	'jp-includes/js/mediaelement/lang/ru.js',
	'jp-includes/js/mediaelement/lang/sk.js',
	'jp-includes/js/mediaelement/lang/sv.js',
	'jp-includes/js/mediaelement/lang/uk.js',
	'jp-includes/js/mediaelement/lang/zh-cn.js',
	'jp-includes/js/mediaelement/lang/zh.js',
	'jp-includes/js/mediaelement/mediaelement-flash-audio-ogg.swf',
	'jp-includes/js/mediaelement/mediaelement-flash-audio.swf',
	'jp-includes/js/mediaelement/mediaelement-flash-video-hls.swf',
	'jp-includes/js/mediaelement/mediaelement-flash-video-mdash.swf',
	'jp-includes/js/mediaelement/mediaelement-flash-video.swf',
	'jp-includes/js/mediaelement/renderers/dailymotion.js',
	'jp-includes/js/mediaelement/renderers/dailymotion.min.js',
	'jp-includes/js/mediaelement/renderers/facebook.js',
	'jp-includes/js/mediaelement/renderers/facebook.min.js',
	'jp-includes/js/mediaelement/renderers/soundcloud.js',
	'jp-includes/js/mediaelement/renderers/soundcloud.min.js',
	'jp-includes/js/mediaelement/renderers/twitch.js',
	'jp-includes/js/mediaelement/renderers/twitch.min.js',
	// 5.0
	'jp-includes/js/codemirror/jshint.js',
);

/**
 * Stores new files in jp-content to copy
 *
 * The contents of this array indicate any new bundled plugins/themes which
 * should be installed with the JonPress Upgrade. These items will not be
 * re-installed in future upgrades, this behaviour is controlled by the
 * introduced version present here being older than the current installed version.
 *
 * The content of this array should follow the following format:
 * Filename (relative to jp-content) => Introduced version
 * Directories should be noted by suffixing it with a trailing slash (/)
 *
 * @since 3.2.0
 * @since 4.7.0 New themes were not automatically installed for 4.4-4.6 on
 *              upgrade. New themes are now installed again. To disable new
 *              themes from being installed on upgrade, explicitly define
 *              CORE_UPGRADE_SKIP_NEW_BUNDLED as false.
 * @global array $_new_bundled_files
 * @var array
 * @name $_new_bundled_files
 */
global $_new_bundled_files;

$_new_bundled_files = array(
	'plugins/akismet/'        => '2.0',
	'themes/twentyten/'       => '3.0',
	'themes/twentyeleven/'    => '3.2',
	'themes/twentytwelve/'    => '3.5',
	'themes/twentythirteen/'  => '3.6',
	'themes/twentyfourteen/'  => '3.8',
	'themes/twentyfifteen/'   => '4.1',
	'themes/twentysixteen/'   => '4.4',
	'themes/twentyseventeen/' => '4.7',
);

/**
 * Upgrades the core of JonPress.
 *
 * This will create a .maintenance file at the base of the JonPress directory
 * to ensure that people can not access the web site, when the files are being
 * copied to their locations.
 *
 * The files in the `$_old_files` list will be removed and the new files
 * copied from the zip file after the database is upgraded.
 *
 * The files in the `$_new_bundled_files` list will be added to the installation
 * if the version is greater than or equal to the old version being upgraded.
 *
 * The steps for the upgrader for after the new release is downloaded and
 * unzipped is:
 *   1. Test unzipped location for select files to ensure that unzipped worked.
 *   2. Create the .maintenance file in current JonPress base.
 *   3. Copy new JonPress directory over old JonPress files.
 *   4. Upgrade JonPress to new version.
 *     4.1. Copy all files/folders other than jp-content
 *     4.2. Copy any language files to JP_LANG_DIR (which may differ from JP_CONTENT_DIR
 *     4.3. Copy any new bundled themes/plugins to their respective locations
 *   5. Delete new JonPress directory path.
 *   6. Delete .maintenance file.
 *   7. Remove old files.
 *   8. Delete 'update_core' option.
 *
 * There are several areas of failure. For instance if PHP times out before step
 * 6, then you will not be able to access any portion of your site. Also, since
 * the upgrade will not continue where it left off, you will not be able to
 * automatically remove old files and remove the 'update_core' option. This
 * isn't that bad.
 *
 * If the copy of the new JonPress over the old fails, then the worse is that
 * the new JonPress directory will remain.
 *
 * If it is assumed that every file will be copied over, including plugins and
 * themes, then if you edit the default theme, you should rename it, so that
 * your changes remain.
 *
 * @since 2.7.0
 *
 * @global JP_Filesystem_Base $jp_filesystem          JonPress filesystem subclass.
 * @global array              $_old_files
 * @global array              $_new_bundled_files
 * @global wpdb               $wpdb
 * @global string             $jp_version
 * @global string             $required_php_version
 * @global string             $required_mysql_version
 *
 * @param string $from New release unzipped path.
 * @param string $to   Path to old JonPress installation.
 * @return JP_Error|null JP_Error on failure, null on success.
 */
function update_core( $from, $to ) {
	global $jp_filesystem, $_old_files, $_new_bundled_files, $wpdb;

	@set_time_limit( 300 );

	/**
	 * Filters feedback messages displayed during the core update process.
	 *
	 * The filter is first evaluated after the zip file for the latest version
	 * has been downloaded and unzipped. It is evaluated five more times during
	 * the process:
	 *
	 * 1. Before JonPress begins the core upgrade process.
	 * 2. Before Maintenance Mode is enabled.
	 * 3. Before JonPress begins copying over the necessary files.
	 * 4. Before Maintenance Mode is disabled.
	 * 5. Before the database is upgraded.
	 *
	 * @since 2.5.0
	 *
	 * @param string $feedback The core update feedback messages.
	 */
	apply_filters( 'update_feedback', __( 'Verifying the unpacked files&#8230;' ) );

	// Sanity check the unzipped distribution.
	$distro = '';
	$roots  = array( '/jonpress/', '/jonpress-mu/' );
	foreach ( $roots as $root ) {
		if ( $jp_filesystem->exists( $from . $root . 'readme.html' ) && $jp_filesystem->exists( $from . $root . 'jp-includes/version.php' ) ) {
			$distro = $root;
			break;
		}
	}
	if ( ! $distro ) {
		$jp_filesystem->delete( $from, true );
		return new JP_Error( 'insane_distro', __( 'The update could not be unpacked' ) );
	}

	/*
	 * Import $jp_version, $required_php_version, and $required_mysql_version from the new version.
	 * DO NOT globalise any variables imported from `version-current.php` in this function.
	 *
	 * BC Note: $jp_filesystem->jp_content_dir() returned unslashed pre-2.8
	 */
	$versions_file = trailingslashit( $jp_filesystem->jp_content_dir() ) . 'upgrade/version-current.php';
	if ( ! $jp_filesystem->copy( $from . $distro . 'jp-includes/version.php', $versions_file ) ) {
		$jp_filesystem->delete( $from, true );
		return new JP_Error( 'copy_failed_for_version_file', __( 'The update cannot be installed because we will be unable to copy some files. This is usually due to inconsistent file permissions.' ), 'jp-includes/version.php' );
	}

	$jp_filesystem->chmod( $versions_file, FS_CHMOD_FILE );
	require( JP_CONTENT_DIR . '/upgrade/version-current.php' );
	$jp_filesystem->delete( $versions_file );

	$php_version       = phpversion();
	$mysql_version     = $wpdb->db_version();
	$old_jp_version    = $GLOBALS['jp_version']; // The version of JonPress we're updating from
	$development_build = ( false !== strpos( $old_jp_version . $jp_version, '-' ) ); // a dash in the version indicates a Development release
	$php_compat        = version_compare( $php_version, $required_php_version, '>=' );
	if ( file_exists( JP_CONTENT_DIR . '/db.php' ) && empty( $wpdb->is_mysql ) ) {
		$mysql_compat = true;
	} else {
		$mysql_compat = version_compare( $mysql_version, $required_mysql_version, '>=' );
	}

	if ( ! $mysql_compat || ! $php_compat ) {
		$jp_filesystem->delete( $from, true );
	}

	if ( ! $mysql_compat && ! $php_compat ) {
		return new JP_Error( 'php_mysql_not_compatible', sprintf( __( 'The update cannot be installed because JonPress %1$s requires PHP version %2$s or higher and MySQL version %3$s or higher. You are running PHP version %4$s and MySQL version %5$s.' ), $jp_version, $required_php_version, $required_mysql_version, $php_version, $mysql_version ) );
	} elseif ( ! $php_compat ) {
		return new JP_Error( 'php_not_compatible', sprintf( __( 'The update cannot be installed because JonPress %1$s requires PHP version %2$s or higher. You are running version %3$s.' ), $jp_version, $required_php_version, $php_version ) );
	} elseif ( ! $mysql_compat ) {
		return new JP_Error( 'mysql_not_compatible', sprintf( __( 'The update cannot be installed because JonPress %1$s requires MySQL version %2$s or higher. You are running version %3$s.' ), $jp_version, $required_mysql_version, $mysql_version ) );
	}

	/** This filter is documented in jp-admin/includes/update-core.php */
	apply_filters( 'update_feedback', __( 'Preparing to install the latest version&#8230;' ) );

	// Don't copy jp-content, we'll deal with that below
	// We also copy version.php last so failed updates report their old version
	$skip              = array( 'jp-content', 'jp-includes/version.php' );
	$check_is_writable = array();

	// Check to see which files don't really need updating - only available for 3.7 and higher
	if ( function_exists( 'get_core_checksums' ) ) {
		// Find the local version of the working directory
		$working_dir_local = JP_CONTENT_DIR . '/upgrade/' . basename( $from ) . $distro;

		$checksums = get_core_checksums( $jp_version, isset( $jp_local_package ) ? $jp_local_package : 'en_US' );
		if ( is_array( $checksums ) && isset( $checksums[ $jp_version ] ) ) {
			$checksums = $checksums[ $jp_version ]; // Compat code for 3.7-beta2
		}
		if ( is_array( $checksums ) ) {
			foreach ( $checksums as $file => $checksum ) {
				if ( 'jp-content' == substr( $file, 0, 10 ) ) {
					continue;
				}
				if ( ! file_exists( ABSPATH . $file ) ) {
					continue;
				}
				if ( ! file_exists( $working_dir_local . $file ) ) {
					continue;
				}
				if ( '.' === dirname( $file ) && in_array( pathinfo( $file, PATHINFO_EXTENSION ), array( 'html', 'txt' ) ) ) {
					continue;
				}
				if ( md5_file( ABSPATH . $file ) === $checksum ) {
					$skip[] = $file;
				} else {
					$check_is_writable[ $file ] = ABSPATH . $file;
				}
			}
		}
	}

	// If we're using the direct method, we can predict write failures that are due to permissions.
	if ( $check_is_writable && 'direct' === $jp_filesystem->method ) {
		$files_writable = array_filter( $check_is_writable, array( $jp_filesystem, 'is_writable' ) );
		if ( $files_writable !== $check_is_writable ) {
			$files_not_writable = array_diff_key( $check_is_writable, $files_writable );
			foreach ( $files_not_writable as $relative_file_not_writable => $file_not_writable ) {
				// If the writable check failed, chmod file to 0644 and try again, same as copy_dir().
				$jp_filesystem->chmod( $file_not_writable, FS_CHMOD_FILE );
				if ( $jp_filesystem->is_writable( $file_not_writable ) ) {
					unset( $files_not_writable[ $relative_file_not_writable ] );
				}
			}

			// Store package-relative paths (the key) of non-writable files in the JP_Error object.
			$error_data = version_compare( $old_jp_version, '3.7-beta2', '>' ) ? array_keys( $files_not_writable ) : '';

			if ( $files_not_writable ) {
				return new JP_Error( 'files_not_writable', __( 'The update cannot be installed because we will be unable to copy some files. This is usually due to inconsistent file permissions.' ), implode( ', ', $error_data ) );
			}
		}
	}

	/** This filter is documented in jp-admin/includes/update-core.php */
	apply_filters( 'update_feedback', __( 'Enabling Maintenance mode&#8230;' ) );
	// Create maintenance file to signal that we are upgrading
	$maintenance_string = '<?php $upgrading = ' . time() . '; ?>';
	$maintenance_file   = $to . '.maintenance';
	$jp_filesystem->delete( $maintenance_file );
	$jp_filesystem->put_contents( $maintenance_file, $maintenance_string, FS_CHMOD_FILE );

	/** This filter is documented in jp-admin/includes/update-core.php */
	apply_filters( 'update_feedback', __( 'Copying the required files&#8230;' ) );
	// Copy new versions of WP files into place.
	$result = _copy_dir( $from . $distro, $to, $skip );
	if ( is_jp_error( $result ) ) {
		$result = new JP_Error( $result->get_error_code(), $result->get_error_message(), substr( $result->get_error_data(), strlen( $to ) ) );
	}

	// Since we know the core files have copied over, we can now copy the version file
	if ( ! is_jp_error( $result ) ) {
		if ( ! $jp_filesystem->copy( $from . $distro . 'jp-includes/version.php', $to . 'jp-includes/version.php', true /* overwrite */ ) ) {
			$jp_filesystem->delete( $from, true );
			$result = new JP_Error( 'copy_failed_for_version_file', __( 'The update cannot be installed because we will be unable to copy some files. This is usually due to inconsistent file permissions.' ), 'jp-includes/version.php' );
		}
		$jp_filesystem->chmod( $to . 'jp-includes/version.php', FS_CHMOD_FILE );
	}

	// Check to make sure everything copied correctly, ignoring the contents of jp-content
	$skip   = array( 'jp-content' );
	$failed = array();
	if ( isset( $checksums ) && is_array( $checksums ) ) {
		foreach ( $checksums as $file => $checksum ) {
			if ( 'jp-content' == substr( $file, 0, 10 ) ) {
				continue;
			}
			if ( ! file_exists( $working_dir_local . $file ) ) {
				continue;
			}
			if ( '.' === dirname( $file ) && in_array( pathinfo( $file, PATHINFO_EXTENSION ), array( 'html', 'txt' ) ) ) {
				$skip[] = $file;
				continue;
			}
			if ( file_exists( ABSPATH . $file ) && md5_file( ABSPATH . $file ) == $checksum ) {
				$skip[] = $file;
			} else {
				$failed[] = $file;
			}
		}
	}

	// Some files didn't copy properly
	if ( ! empty( $failed ) ) {
		$total_size = 0;
		foreach ( $failed as $file ) {
			if ( file_exists( $working_dir_local . $file ) ) {
				$total_size += filesize( $working_dir_local . $file );
			}
		}

		// If we don't have enough free space, it isn't worth trying again.
		// Unlikely to be hit due to the check in unzip_file().
		$available_space = @disk_free_space( ABSPATH );
		if ( $available_space && $total_size >= $available_space ) {
			$result = new JP_Error( 'disk_full', __( 'There is not enough free disk space to complete the update.' ) );
		} else {
			$result = _copy_dir( $from . $distro, $to, $skip );
			if ( is_jp_error( $result ) ) {
				$result = new JP_Error( $result->get_error_code() . '_retry', $result->get_error_message(), substr( $result->get_error_data(), strlen( $to ) ) );
			}
		}
	}

	// Custom Content Directory needs updating now.
	// Copy Languages
	if ( ! is_jp_error( $result ) && $jp_filesystem->is_dir( $from . $distro . 'jp-content/languages' ) ) {
		if ( JP_LANG_DIR != ABSPATH . WPINC . '/languages' || @is_dir( JP_LANG_DIR ) ) {
			$lang_dir = JP_LANG_DIR;
		} else {
			$lang_dir = JP_CONTENT_DIR . '/languages';
		}

		if ( ! @is_dir( $lang_dir ) && 0 === strpos( $lang_dir, ABSPATH ) ) { // Check the language directory exists first
			$jp_filesystem->mkdir( $to . str_replace( ABSPATH, '', $lang_dir ), FS_CHMOD_DIR ); // If it's within the ABSPATH we can handle it here, otherwise they're out of luck.
			clearstatcache(); // for FTP, Need to clear the stat cache
		}

		if ( @is_dir( $lang_dir ) ) {
			$jp_lang_dir = $jp_filesystem->find_folder( $lang_dir );
			if ( $jp_lang_dir ) {
				$result = copy_dir( $from . $distro . 'jp-content/languages/', $jp_lang_dir );
				if ( is_jp_error( $result ) ) {
					$result = new JP_Error( $result->get_error_code() . '_languages', $result->get_error_message(), substr( $result->get_error_data(), strlen( $jp_lang_dir ) ) );
				}
			}
		}
	}

	/** This filter is documented in jp-admin/includes/update-core.php */
	apply_filters( 'update_feedback', __( 'Disabling Maintenance mode&#8230;' ) );
	// Remove maintenance file, we're done with potential site-breaking changes
	$jp_filesystem->delete( $maintenance_file );

	// 3.5 -> 3.5+ - an empty twentytwelve directory was created upon upgrade to 3.5 for some users, preventing installation of Twenty Twelve.
	if ( '3.5' == $old_jp_version ) {
		if ( is_dir( JP_CONTENT_DIR . '/themes/twentytwelve' ) && ! file_exists( JP_CONTENT_DIR . '/themes/twentytwelve/style.css' ) ) {
			$jp_filesystem->delete( $jp_filesystem->jp_themes_dir() . 'twentytwelve/' );
		}
	}

	// Copy New bundled plugins & themes
	// This gives us the ability to install new plugins & themes bundled with future versions of JonPress whilst avoiding the re-install upon upgrade issue.
	// $development_build controls us overwriting bundled themes and plugins when a non-stable release is being updated
	if ( ! is_jp_error( $result ) && ( ! defined( 'CORE_UPGRADE_SKIP_NEW_BUNDLED' ) || ! CORE_UPGRADE_SKIP_NEW_BUNDLED ) ) {
		foreach ( (array) $_new_bundled_files as $file => $introduced_version ) {
			// If a $development_build or if $introduced version is greater than what the site was previously running
			if ( $development_build || version_compare( $introduced_version, $old_jp_version, '>' ) ) {
				$directory             = ( '/' == $file[ strlen( $file ) - 1 ] );
				list($type, $filename) = explode( '/', $file, 2 );

				// Check to see if the bundled items exist before attempting to copy them
				if ( ! $jp_filesystem->exists( $from . $distro . 'jp-content/' . $file ) ) {
					continue;
				}

				if ( 'plugins' == $type ) {
					$dest = $jp_filesystem->jp_plugins_dir();
				} elseif ( 'themes' == $type ) {
					$dest = trailingslashit( $jp_filesystem->jp_themes_dir() ); // Back-compat, ::jp_themes_dir() did not return trailingslash'd pre-3.2
				} else {
					continue;
				}

				if ( ! $directory ) {
					if ( ! $development_build && $jp_filesystem->exists( $dest . $filename ) ) {
						continue;
					}

					if ( ! $jp_filesystem->copy( $from . $distro . 'jp-content/' . $file, $dest . $filename, FS_CHMOD_FILE ) ) {
						$result = new JP_Error( "copy_failed_for_new_bundled_$type", __( 'Could not copy file.' ), $dest . $filename );
					}
				} else {
					if ( ! $development_build && $jp_filesystem->is_dir( $dest . $filename ) ) {
						continue;
					}

					$jp_filesystem->mkdir( $dest . $filename, FS_CHMOD_DIR );
					$_result = copy_dir( $from . $distro . 'jp-content/' . $file, $dest . $filename );

					// If a error occurs partway through this final step, keep the error flowing through, but keep process going.
					if ( is_jp_error( $_result ) ) {
						if ( ! is_jp_error( $result ) ) {
							$result = new JP_Error;
						}
						$result->add( $_result->get_error_code() . "_$type", $_result->get_error_message(), substr( $_result->get_error_data(), strlen( $dest ) ) );
					}
				}
			}
		} //end foreach
	}

	// Handle $result error from the above blocks
	if ( is_jp_error( $result ) ) {
		$jp_filesystem->delete( $from, true );
		return $result;
	}

	// Remove old files
	foreach ( $_old_files as $old_file ) {
		$old_file = $to . $old_file;
		if ( ! $jp_filesystem->exists( $old_file ) ) {
			continue;
		}

		// If the file isn't deleted, try writing an empty string to the file instead.
		if ( ! $jp_filesystem->delete( $old_file, true ) && $jp_filesystem->is_file( $old_file ) ) {
			$jp_filesystem->put_contents( $old_file, '' );
		}
	}

	// Remove any Genericons example.html's from the filesystem
	_upgrade_422_remove_genericons();

	// Remove the REST API plugin if its version is Beta 4 or lower
	_upgrade_440_force_deactivate_incompatible_plugins();

	// Upgrade DB with separate request
	/** This filter is documented in jp-admin/includes/update-core.php */
	apply_filters( 'update_feedback', __( 'Upgrading database&#8230;' ) );
	$db_upgrade_url = admin_url( 'upgrade.php?step=upgrade_db' );
	jp_remote_post( $db_upgrade_url, array( 'timeout' => 60 ) );

	// Clear the cache to prevent an update_option() from saving a stale db_version to the cache
	jp_cache_flush();
	// (Not all cache back ends listen to 'flush')
	jp_cache_delete( 'alloptions', 'options' );

	// Remove working directory
	$jp_filesystem->delete( $from, true );

	// Force refresh of update information
	if ( function_exists( 'delete_site_transient' ) ) {
		delete_site_transient( 'update_core' );
	} else {
		delete_option( 'update_core' );
	}

	/**
	 * Fires after JonPress core has been successfully updated.
	 *
	 * @since 3.3.0
	 *
	 * @param string $jp_version The current JonPress version.
	 */
	do_action( '_core_updated_successfully', $jp_version );

	// Clear the option that blocks auto updates after failures, now that we've been successful.
	if ( function_exists( 'delete_site_option' ) ) {
		delete_site_option( 'auto_core_update_failed' );
	}

	return $jp_version;
}

/**
 * Copies a directory from one location to another via the JonPress Filesystem Abstraction.
 * Assumes that JP_Filesystem() has already been called and setup.
 *
 * This is a temporary function for the 3.1 -> 3.2 upgrade, as well as for those upgrading to
 * 3.7+
 *
 * @ignore
 * @since 3.2.0
 * @since 3.7.0 Updated not to use a regular expression for the skip list
 * @see copy_dir()
 *
 * @global JP_Filesystem_Base $jp_filesystem
 *
 * @param string $from     source directory
 * @param string $to       destination directory
 * @param array $skip_list a list of files/folders to skip copying
 * @return mixed JP_Error on failure, True on success.
 */
function _copy_dir( $from, $to, $skip_list = array() ) {
	global $jp_filesystem;

	$dirlist = $jp_filesystem->dirlist( $from );

	$from = trailingslashit( $from );
	$to   = trailingslashit( $to );

	foreach ( (array) $dirlist as $filename => $fileinfo ) {
		if ( in_array( $filename, $skip_list ) ) {
			continue;
		}

		if ( 'f' == $fileinfo['type'] ) {
			if ( ! $jp_filesystem->copy( $from . $filename, $to . $filename, true, FS_CHMOD_FILE ) ) {
				// If copy failed, chmod file to 0644 and try again.
				$jp_filesystem->chmod( $to . $filename, FS_CHMOD_FILE );
				if ( ! $jp_filesystem->copy( $from . $filename, $to . $filename, true, FS_CHMOD_FILE ) ) {
					return new JP_Error( 'copy_failed__copy_dir', __( 'Could not copy file.' ), $to . $filename );
				}
			}
		} elseif ( 'd' == $fileinfo['type'] ) {
			if ( ! $jp_filesystem->is_dir( $to . $filename ) ) {
				if ( ! $jp_filesystem->mkdir( $to . $filename, FS_CHMOD_DIR ) ) {
					return new JP_Error( 'mkdir_failed__copy_dir', __( 'Could not create directory.' ), $to . $filename );
				}
			}

			/*
			 * Generate the $sub_skip_list for the subdirectory as a sub-set
			 * of the existing $skip_list.
			 */
			$sub_skip_list = array();
			foreach ( $skip_list as $skip_item ) {
				if ( 0 === strpos( $skip_item, $filename . '/' ) ) {
					$sub_skip_list[] = preg_replace( '!^' . preg_quote( $filename, '!' ) . '/!i', '', $skip_item );
				}
			}

			$result = _copy_dir( $from . $filename, $to . $filename, $sub_skip_list );
			if ( is_jp_error( $result ) ) {
				return $result;
			}
		}
	}
	return true;
}

/**
 * Redirect to the About JonPress page after a successful upgrade.
 *
 * This function is only needed when the existing installation is older than 3.4.0.
 *
 * @since 3.3.0
 *
 * @global string $jp_version
 * @global string $pagenow
 * @global string $action
 *
 * @param string $new_version
 */
function _redirect_to_about_jonpress( $new_version ) {
	global $jp_version, $pagenow, $action;

	if ( version_compare( $jp_version, '3.4-RC1', '>=' ) ) {
		return;
	}

	// Ensure we only run this on the update-core.php page. The Core_Upgrader may be used in other contexts.
	if ( 'update-core.php' != $pagenow ) {
		return;
	}

	if ( 'do-core-upgrade' != $action && 'do-core-reinstall' != $action ) {
		return;
	}

	// Load the updated default text localization domain for new strings.
	load_default_textdomain();

	// See do_core_upgrade()
	show_message( __( 'JonPress updated successfully' ) );

	// self_admin_url() won't exist when upgrading from <= 3.0, so relative URLs are intentional.
	show_message( '<span class="hide-if-no-js">' . sprintf( __( 'Welcome to JonPress %1$s. You will be redirected to the About JonPress screen. If not, click <a href="%2$s">here</a>.' ), $new_version, 'about.php?updated' ) . '</span>' );
	show_message( '<span class="hide-if-js">' . sprintf( __( 'Welcome to JonPress %1$s. <a href="%2$s">Learn more</a>.' ), $new_version, 'about.php?updated' ) . '</span>' );
	echo '</div>';
	?>
<script type="text/javascript">
window.location = 'about.php?updated';
</script>
	<?php

	// Include admin-footer.php and exit.
	include( ABSPATH . 'jp-admin/admin-footer.php' );
	exit();
}

/**
 * Cleans up Genericons example files.
 *
 * @since 4.2.2
 *
 * @global array              $jp_theme_directories
 * @global JP_Filesystem_Base $jp_filesystem
 */
function _upgrade_422_remove_genericons() {
	global $jp_theme_directories, $jp_filesystem;

	// A list of the affected files using the filesystem absolute paths.
	$affected_files = array();

	// Themes
	foreach ( $jp_theme_directories as $directory ) {
		$affected_theme_files = _upgrade_422_find_genericons_files_in_folder( $directory );
		$affected_files       = array_merge( $affected_files, $affected_theme_files );
	}

	// Plugins
	$affected_plugin_files = _upgrade_422_find_genericons_files_in_folder( JP_PLUGIN_DIR );
	$affected_files        = array_merge( $affected_files, $affected_plugin_files );

	foreach ( $affected_files as $file ) {
		$gen_dir = $jp_filesystem->find_folder( trailingslashit( dirname( $file ) ) );
		if ( empty( $gen_dir ) ) {
			continue;
		}

		// The path when the file is accessed via JP_Filesystem may differ in the case of FTP
		$remote_file = $gen_dir . basename( $file );

		if ( ! $jp_filesystem->exists( $remote_file ) ) {
			continue;
		}

		if ( ! $jp_filesystem->delete( $remote_file, false, 'f' ) ) {
			$jp_filesystem->put_contents( $remote_file, '' );
		}
	}
}

/**
 * Recursively find Genericons example files in a given folder.
 *
 * @ignore
 * @since 4.2.2
 *
 * @param string $directory Directory path. Expects trailingslashed.
 * @return array
 */
function _upgrade_422_find_genericons_files_in_folder( $directory ) {
	$directory = trailingslashit( $directory );
	$files     = array();

	if ( file_exists( "{$directory}example.html" ) && false !== strpos( file_get_contents( "{$directory}example.html" ), '<title>Genericons</title>' ) ) {
		$files[] = "{$directory}example.html";
	}

	$dirs = glob( $directory . '*', GLOB_ONLYDIR );
	if ( $dirs ) {
		foreach ( $dirs as $dir ) {
			$files = array_merge( $files, _upgrade_422_find_genericons_files_in_folder( $dir ) );
		}
	}

	return $files;
}

/**
 * @ignore
 * @since 4.4.0
 */
function _upgrade_440_force_deactivate_incompatible_plugins() {
	if ( defined( 'REST_API_VERSION' ) && version_compare( REST_API_VERSION, '2.0-beta4', '<=' ) ) {
		deactivate_plugins( array( 'rest-api/plugin.php' ), true );
	}
}
