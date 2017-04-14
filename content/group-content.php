<div class="jumbotron col-lg-6">
    <h3 class="center-text"><?php echo $nameGroup; ?></h3>
    <table class="table table-bordered">
        <tbody><tr>
            <td><b>Admin:</b></td>
            <td><?php echo '<a href="profile?id='.$admin.'">'.$fullname.'</a>'; ?></td>
        </tr>
        <tr>
            <td><b>Status Grupy</b></td>
            <td><?php echo \User\User::showStatusGroup($status); ?></td>
        </tr>
        <tr>
            <td><b>Ilość członków</b></td>
            <td><?php echo \User\User::showCountMembersGroup($id); ?></td>
        </tr>
        </tbody>
    </table>
</div>