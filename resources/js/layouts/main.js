const MAIN = {
    init() {
        this.activeMenu();
    },

    activeMenu() {
        // const currentUrl = window.location.href;

        // const urlParts = currentUrl.split("/");

        // const menu = urlParts[3];

        // $(`.nav-item .nav-link[data-menu="${menu}"]`).addClass('active')
    },
};

$(document).ready(function () {
    MAIN.init();
});
