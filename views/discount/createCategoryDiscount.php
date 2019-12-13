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
        <label for="inputCodeCategoryDiscount">Code:</label>
        <input type="text" class="inputCode" aria-label="inputCodeCategoryDiscount" id="inputCodeCategoryDiscount">
    </div>
    <div class="form-group">
        <label class="descriptionPopUp" for="descriptionDiscountCategory">Omschrijving:</label>
        <textarea class="form-control" id="descriptionDiscountCategory" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="inputPercentageDiscountCategory">Percentage:</label>
        <input type="text" class="inputPercentage" aria-label="inputPercentageDiscountCategory" id="inputPercentageDiscountCategory">
    </div>
    <div class="form-group">
        <label for="inputPercentageDiscountCategory">Begin periode:</label>
        <input type="date" class="inputStartDate" id="inputStartDateDiscountCategory">
    </div>
    <div class="form-group">
        <p class="einde-periode">Einde periode:</p>
        <input type="date" class="inputEndDate" id="inputEndDateDiscountCategory">
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