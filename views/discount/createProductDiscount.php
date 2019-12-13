<?php


use Model\Discount;
if (isset($_POST['submit'])) {
    include 'loader.php';
    $discount = new Discount();


    $discountController->store($discount);
    die();
}

?>
<form method="POST">
    <div class="form-group">
        <label for="inputCodeProductDiscount">Code:</label>
        <input type="text" class="inputCode" aria-label="inputCodeProductDiscount" id="inputCodeProductDiscount">
    </div>
    <div class="form-group">
        <input class="form-check-input" type="checkbox" value="" id="checkboxDiscountProduct">
        <label class="form-check-label" for="checkboxDiscountProduct">Eenmalig</label>
    </div>
    <div class="form-group">
        <label class="descriptionPopUp" for="descriptionDiscountProduct">Omschrijving:</label>
        <textarea class="form-control" id="descriptionDiscountProduct" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="inputPercentageDiscountProduct">Percentage:</label>
        <input type="text" class="inputPercentage" aria-label="inputPercentageDiscountProduct" id="inputPercentageDiscountProduct">
    </div>
    <div class="form-group">
        label for="inputPercentageDiscountProduct">Begin periode:</label>
        <input type="date" class="inputStartDate" id="inputStartDateDiscountProduct">
    </div>
    <div class="form-group">
        <p class="einde-periode">Einde periode:</p>
        <input type="date" class="inputEndDate" id="inputEndDateDiscountProduct">
    </div>
</form>

<script
        src="http://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script>

    $('input').each(function(){
        if($(this).attr('type') == 'text' ){
            $(this).val($(this).attr('name'))
        }
        else if($(this).attr('type') == 'number' && $(this).val() == "")
        {
            $(this).val(Math.round(Math.random() * 10 ));
        }
    })

</script>