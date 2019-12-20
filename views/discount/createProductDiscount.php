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
        <label for="inputCodePD">Code:</label>
        <input type="text" class="form-control inputCode" name="DealCode" aria-label="inputCodePD" id="inputCodeDP">
        <button type="button" class="btn btn-outline-secondary" onclick="generateCodeDP();">Genereer code</button>
    </div>
    <div class="form-group">
        <label for="checkboxDP">Eenmalig:</label>
        <input class="checkboxOneTime" type="checkbox" name="OneTime" id="checkboxDP">
    </div>
    <div class="form-group">
        <label class="descriptionPopUp" for="descriptionDP">Omschrijving:</label>
        <textarea class="form-control dealDescription" name="DealDescription" id="descriptionDP" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="inputPercentageDP">Percentage:</label>
        <input type="text" class="form-control inputPercentage" aria-label="inputPercentageDP" name="DiscountPercentage" id="inputPercentageDP">
        <span class="symbolPercentage">%</span>
    </div>
    <div class="form-group">
        <label for="inputStartDateDP">Begin periode:</label>
        <input type="date" class="form-control inputStartDate" name="StartDate" id="inputStartDateDP">
    </div>
    <div class="form-group">
        <label for="inputEndDateDP">Einde periode:</label>
        <input type="date" class="form-control inputEndDate" name="EndDate" id="inputEndDateDP">
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