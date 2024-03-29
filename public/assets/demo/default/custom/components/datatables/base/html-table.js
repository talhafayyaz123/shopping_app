var DatatableHtmlTableDemo = function () {
    var e = function () {
        $(".m-datatable").mDatatable({
            search: {input: $("#generalSearch")},
            columns: [{field: "Deposit Paid", type: "number"}, {
                field: "Order Date",
                type: "date",
                format: "YYYY-MM-DD"
            }]
        })
    };
    return {
        init: function () {
            e()
        }
    }
}();
jQuery(document).ready(function () {
    DatatableHtmlTableDemo.init()
});
