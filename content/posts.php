<div class="jumbotron col-lg-6">
  <div class="col-lg-12">
      <h2 class="center-text">Posty</h2><br>
        <form method="post">
          <div class="form-group">
          <label for="exampleTextarea">Dodaj Post</label>

                  <textarea class="form-control" name="postText" placeholder="Wpisz o czym teraz myślisz..." name="newPostAdd"></textarea><br>
                  <button type="submit" class="btn btn-primary">Dodaj Post</button>
          </div>
        </form>
      </div>
    <?php \User\User::showPost(); ?>
    </ul>
    </div><!-- Posts -->