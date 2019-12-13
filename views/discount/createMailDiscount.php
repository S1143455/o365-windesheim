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
        <label for="inputCodeMailDiscount">Code:</label>
        <input type="text" class="inputCode" aria-label="inputCodeMailDiscount" id="inputCodeMailDiscount">
    </div>
    <div class="form-group">
        <input class="form-check-input" type="checkbox" value="" id="checkboxMailDiscount">
        <label class="form-check-label" for="checkboxMailDiscount">Eenmalig</label>
    </div>
    <div class="form-group">
        <label class="descriptionPopUp" for="descriptionMailDiscount">Omschrijving:</label>
        <textarea class="form-control" id="descriptionMailDiscount" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="inputPercentageMailDiscount">Percentage:</label>
        <input type="text" class="inputPercentage" aria-label="inputPercentageMailDiscount" id="inputPercentageMailDiscount">
    </div>
    <div class="form-group">
        <label for="inputPercentageMailDiscount">Begin periode:</label>
        <input type="date" class="inputStartDate" id="inputStartDateMailDiscount">
    </div>
    <div class="form-group">
        <p class="einde-periode">Einde periode:</p>
        <input type="date" class="inputEndDate" id="inputEndDateMailDiscount">
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Email:</label>
        <input type="email" class="form-control" id="inputEmail3">
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