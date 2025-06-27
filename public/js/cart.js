$(document).ready(function () {
    //when plus button click
    $(".btn-plus").click(function () {
        $parentNode = $(this).parents("tr");
        $price = Number(
            $parentNode.find("#pizzaPrice").text().replace("Rp.", "")
        );
        $qty = Number($parentNode.find("#qty").val());
        $total = $price * $qty;
        $parentNode.find("#total").html($total + " Rp.");
        summaryCalculation();
    });

    $(".btn-minus").click(function () {
        //when minus button click
        $parentNode = $(this).parents("tr");
        $price = Number(
            $parentNode.find("#pizzaPrice").text().replace("Rp.", "")
        );
        $qty = Number($parentNode.find("#qty").val());
        $total = $price * $qty;
        $parentNode.find("#total").html($total + " Rp.");

        summaryCalculation();
    });

    function summaryCalculation() {
        //calculate final total
        $totalPrice = 0;
        $("#dataTable tbody tr").each(function (index, row) {
            $totalPrice += Number(
                $(row).find("#total").text().replace("Rp.", "")
            );
        });

        $("#subTotalPrice").html(`${$totalPrice} Rp.`);
        $("#finalTotal").html(`${$totalPrice + 3000} Rp.`);
    }
});
