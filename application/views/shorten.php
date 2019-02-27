<!DOCTYPE html>
<html>
<head>
    <title>Shortener EM</title>
</head>
<body>
    <div>
        
        
        <form action="urluser" method="POST">
            <label>
            <center>
                <input type="text" name="url_data" placeholder="Paste a link to shorten it" autocomplete="off"/>
                <input type="text" name="url_custom" placeholder="Custom your link" autocomplete="off"/>
                <input type="submit" value="Shorten"/>
            </center>
            </label>
        </form>
        <center>
        <?php echo validation_errors(); ?>
        </center>
    </div>
</body>
</html>