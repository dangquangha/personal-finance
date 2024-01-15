const TRANSACTIONS = {
    init() {
        this.buildSelect2();
        this.buildJqueryMask()
    },

    buildSelect2() {
        $('#package-select').select2({
            placeholder: "Select a package",
        });
    },

    buildJqueryMask() {
        $('#amount').mask("0.000.000.000.000", {reverse: true});
    }
}

$(document).ready(function () {
    TRANSACTIONS.init();
});
