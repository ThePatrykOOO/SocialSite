<div class="jumbotron col-lg-6 col-md-6">
  <div class="col-lg-12">
      <h2 class="center-text">Posty</h2><br>
      <div class="form-group">
          <label for="exampleTextarea">Dodaj Post</label>
              <?php
              if (isset($_SESSION['errorUser']) && count($_SESSION['errorUser']) > 0) {
                  \Error\Error::showErrors($_SESSION['errorUser']);
                  unset($_SESSION['errorUser']);
              }
              ?>
          <textarea class="form-control" name="postText" id="postText" placeholder="Wpisz o czym teraz myślisz..." name="newPostAdd"></textarea><br>
          <button type="submit" class="btn btn-primary" id="addPost">Dodaj Post</button>
      </div>
  </div>
  <div id="posts">
      <?php
      \User\User::showMainPost();
      ?>
  </div>
</div><!-- Posts -->