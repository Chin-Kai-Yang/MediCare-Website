<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <style>
        /* NAViGATION BAR */
        .menu {
            background-color: var(--DARKCO);
            color: var(--WHITECO);
            display: flex;
            flex-flow: row nowrap;
            max-height: 5vh;
            min-height: 80px;
            position: sticky;
            top: 0;
            z-index: 5;
        }

        .menu header {
            flex: 1;
            margin: 1rem;
            display: flex;
            flex-flow: row nowrap;
            align-items: center;
        }

        .menu header h1 {
            font-size: var(--FS-XL);
            align-self: center;
            display: inline-block;
        }

        .menu nav {
            margin: 10px;
            text-transform: uppercase;
            flex: 2;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .menu ul li a,
        .menu ul p {
            color: var(--WHITECO);
            display: inline-block;
            font-size: var(--FS);
            padding: 1rem;
            text-decoration: none;
        }

        .menu ul li {
            display: inline-block;
            list-style: none;
        }

        /* GO TO TOP BUTTON */
        .to-top {
            background-color: var(--DARKCO);
            bottom: 20px;
            display: grid;
            height: 80px;
            place-content: center;
            position: fixed;
            right: 0;
            width: 80px;
            z-index: 5;
        }

        .to-top h1 {
            display: inline-block;
            font-size: 60px;
        }

        .to-toplink {
            color: var(--WHITECO);
        }
    </style>
</head>

<body>
    <div class="menu">
        <header><img src="./Image/main/logo.png" alt="Logo" width="60" height="60">
            <h1>Medicare+</h1>
        </header>
        <nav>
            <ul>
                <li><a href="homepage3.php">Home</a></li>
                <li><a href="#">History</a></li>
                <li><a href="support.php">Support</a></li>
            </ul>
        </nav>
    </div>
    <a href="#" class="to-toplink">
        <div class="to-top">
            <h1>&#10506;</h1>
        </div>
    </a>
</body>

</html>