<!DOCTYPE html>
<html>
<head>
    <title>Form Login</title>
</head>
<body>
    <h3>Form Login</h3>
    <hr/>
    <form method="post" action="aksi_login.php">
        <table>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><input type="text" name="username"/></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><input type="password" name="password"/></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <input type="submit" value="Login"/>
                    <input type="reset" value="Reset"/>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>