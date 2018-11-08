<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>module-307-knw2</title>
</head>
<body>
<div class="header">
    <h1>module-307-knw2</h1>
    <hr>
    <br>
</div>
<div class="all">
    <form action="endpoint.php" method="post">
        <div class="section">
            <div class="item">
                <p>From</p>
                <label>
                    <input type="text" name="from">
                </label>
            </div>
            <div class="item">
                <p>To</p>
                <label>
                    <input type="text" name="to">
                </label>
            </div>
        </div>
        <div class="section">
            <div class="item">
                <p>Via (comma separated)</p>
                <label>
                    <input type="text" name="via">
                </label>
            </div>
            <div class="item">
                <p>Date and time</p>
                <label>
                    <input type="radio" name="date_time_info" value="depart" checked>
                </label> Depart<br>
                <label>
                    <input type="radio" name="date_time_info" value="arrive">
                </label> Arrive<br>
                <label>
                    <input type="datetime-local" name="date_time">
                </label>
            </div>
        </div>
    </form>
</div>
</body>
</html>