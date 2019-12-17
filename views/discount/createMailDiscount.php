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
        <label for="inputCodeMD">Code:</label>
        <input type="text" class="form-control inputCode" name="DealCode" aria-label="inputCodeMD" id="inputCodeMD">
        <button type="button" class="btn btn-outline-secondary" onclick="generateCodeMD();">Genereer code</button>
    </div>
    <div class="form-group">
        <label for="checkboxMD">Eenmalig:</label>
        <input class="form-control checkboxOneTime" type="checkbox" name="OneTime" id="checkboxMD">
    </div>
    <div class="form-group">
        <label class="descriptionPopUp" for="descriptionMD">Omschrijving:</label>
        <textarea class="form-control dealDescription" name="DealDescription" id="descriptionMD" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="inputPercentageMD">Percentage:</label>
        <input type="text" class="form-control inputPercentage" name="DiscountPercentage" aria-label="inputPercentageMD" id="inputPercentageMD">
        <span class="symbolPercentage">%</span>
    </div>
    <div class="form-group">
        <label for="inputPercentageMD">Begin periode:</label>
        <input type="date" class="form-control inputStartDate" name="StartDate" id="inputStartMD">
    </div>
    <div class="form-group">
        <label for="inputEndDateMD">Einde periode:</label>
        <input type="date" class="form-control inputEndDate" name="EndDate" id="inputEndDateMD">
    </div>
    <div class="form-group">
        <label for="inputEmail">Email:</label>
        <input type="email" class="form-control inputEmail" id="inputEmail">
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