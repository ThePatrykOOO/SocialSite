<div class="jumbotron col-lg-6">
    <h2>Twój Profil
        <a href="edytuj-profil" class="dropdown-toggle" title="Edytuj Profil"><i class="fa fa-cog"></i></a>
    </h2>
    <table class="table table-bordered">
        <tr>
            <td><b>Imie:</b></td>
            <td>Moje Imie</td>
        </tr>
        <tr>
            <td><b>Nazwisko</b></td>
            <td>Moje nazwisko</td>
        </tr>
        <tr>
            <td><b>Email</b></td>
            <td>Moj email</td>
        </tr>
    </table>
    <button type="button" id="more-profil" class="btn btn-primary">Więcej »</button>
    <table class="table table-bordered" id="profil-hide">
        <tr>
            <td><b>Data urodzenia</b></td>
            <td>DATA</td>
        </tr>
        <tr>
            <td><b>Miejsce Zamieszkania</b></td>
            <td>MIEJSCE</td>
        </tr>
        <tr>
            <td><b>Praca</b></td>
            <td>PRACA</td>
        </tr>
        <tr>
            <td><b>Telefon</b></td>
            <td>PHONE</td>
        </tr>
        <tr>
            <td><b>O mnie</b></td>
            <td>Lorem o mniedsa lorem</td>
        </tr>
    </table>
    <div class="col-lg-12">
        <h2 class="center-text">Twoje Posty</h2><br>
        <form>
            <div class="form-group">
                <label for="exampleTextarea">Dodaj Post</label>
                <textarea class="form-control" id="exampleTextarea" placeholder="Wpisz o czym teraz myślisz..." name="newPostAdd"></textarea><br>
                <button type="submit" class="btn btn-primary">Dodaj Post</button>
            </div>
        </form>
    </div>
    <div class="col-lg-12">
        <h4>Patryk Filipiak<small>13.03.2017</small></h4>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
        <div class="optionsPost">
            <button type="button" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i>Polub</button>
            <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down"></i>Nie lubię</button>
            <button type="button" class="btn btn-warning btn-xs"><i class="fa fa-comment"></i>Komentarz</button>
            <button type="button" class="btn btn-info btn-xs"><i class="fa fa-hand-paper-o"></i>Zgłoś</button>
            <!-- <div class="commentSection">
              <span>Patryk Filipiak</span>
              <span><data>19.01.2020</data></span>
              <p>Lorem ipsum dolor sit amet</p>
              <button type="button" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i>Polub</button>
            </div>  --><!-- comentSection -->
        </div>
    </div>
    </ul>
</div><!-- Posts -->