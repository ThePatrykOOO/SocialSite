<div class="jumbotron col-lg-6 col-md-6" >
    <h4>Czat: <?php echo $fullname ?></h4>
    <div class="messenger" id="messageScroll"></div>

    <div class="form-group">
        <?php
        if (isset($_SESSION['errorUser']) && count($_SESSION['errorUser']) > 0) {
            Error\Error::showErrors($_SESSION['errorUser']);
            unset($_SESSION['errorUser']);
        }
        ?>
        <textarea class="form-control" id="message" rows="2" name="message" placeholder="Napisz Wiadomość"></textarea>
        <button type="submit" class="btn btn-success btn-block" id="sendMessage"value="<?php echo $id ?>" >Wyślij</button>
    </div>

</div>