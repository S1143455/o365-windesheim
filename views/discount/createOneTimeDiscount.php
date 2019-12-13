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
        <label for="inputCodeOneTime">Code:</label>
        <input type="text" class="inputCode" aria-label="inputCodeOneTime" id="inputCodeOneTime">
    </div>
    <div class="form-group">
        <input class="form-check-input" type="checkbox" value="" name="checkboxOneTime" id="checkboxOneTime">
        <label class="form-check-label" for="checkboxOneTime">Eenmalig</label>
    </div>
    <div class="form-group">
        <label for="inputPercentageOneTime">Percentage:</label>
        <input type="text" class="inputPercentage" aria-label="inputPercentageOneTime" id="inputPercentageOneTime">
    </div>
    <div class="form-group">
        <label for="inputPercentageOneTime">Begin periode:</label>
        <input type="date" class="inputStartDate" id="inputStartDateOneTimeDiscount">
    </div>
    <div class="form-group">
        <p class="einde-periode">Einde periode:</p>
        <input type="date" class="inputEndDate" id="inputEndDateOneTimeDiscount">
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