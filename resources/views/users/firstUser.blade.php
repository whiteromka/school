<?php
/** @var User $firstUser */

use App\Models\User;

?>

<h1>Users Controller</h1>
<h2>First User</h2>

<?php
    echo "$firstUser->name $firstUser->id $firstUser->email";
?>
