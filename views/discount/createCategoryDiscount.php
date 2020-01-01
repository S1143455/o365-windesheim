<?php


use Model\Discount;
if (isset($_POST['submit'])) {
    include 'loader.php';
    $discount = new Discount();


    $discountController->store($discount);

    $product =
    die();
}

?>
<form method="POST">
    <div class="form-group">
        <label for="inputCodeDC">Code:</label>
        <input type="text" class="form-control inputCode" name="DealCode" aria-label="inputCodeDC" id="inputCodeDC">
        <button type="button" class="btn btn-outline-secondary" onclick="generateCodeDC();">Genereer code</button>
    </div>
    <div class="form-group">
        <label class="descriptionPopUp" for="descriptionDC">Omschrijving:</label>
        <textarea class="form-control dealDescription" name="DealDescription" id="descriptionDC" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="inputPercentageDC">Percentage:</label>
        <input type="text" class="form-control inputPercentage" name="DiscountPercentage" aria-label="inputPercentageDC" id="inputPercentageDC">
        <span class="symbolPercentage">%</span>
    </div>
    <div class="form-group">
        <label for="inputStartDateDC">Begin periode:</label>
        <input type="date" class="form-control inputStartDate" name="StartDate" id="inputStartDateDC">
    </div>
    <div class="form-group">
        <label for="inputEndDateDC">Einde periode:</label>
        <input type="date" class="form-control inputEndDate" name="EndDate" id="inputEndDateDC">
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