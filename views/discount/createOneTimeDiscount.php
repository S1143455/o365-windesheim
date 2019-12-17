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
        <label for="inputCodeOT">Code:</label>
        <input type="text" class="form-control inputCode" name="DealCode" id="inputCodeOT">
        <button type="button" class="btn btn-outline-secondary" onclick="generateCodeOT();">Genereer code</button>
    </div>
    <div class="form-group">
        <label class="form-check-label" for="checkboxOT">Eenmalig:</label>
        <input class="form-control checkboxOneTime" type="checkbox" name="OneTime" id="checkboxOT">
    </div>
    <div class="form-group">
        <label for="inputPercentageOTe">Percentage:</label>
        <input type="text" class="form-control inputPercentage" name="DiscountPercentage" aria-label="inputPercentageOT" id="inputPercentageOT">
        <span class="symbolPercentage">%</span>
    </div>
    <div class="form-group">
        <label for="inputPercentageOT"><span class="inputPercentageOT">Begin periode:</span></label>
        <input type="date" class="form-control inputStartDate" name="StartDate" id="inputStartDateOT">
    </div>
    <div class="form-group">
        <label for="inputEndDateOT">Einde periode:</label>
        <input type="date" class="form-control inputEndDate" name="EndDate" id="inputEndDateOT">
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