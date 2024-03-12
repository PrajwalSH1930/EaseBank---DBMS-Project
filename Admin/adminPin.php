<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .pinForm {
        background: #fff;
        padding: 24px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 12px;
        width: 300px;
        margin-top: 96px;
        margin-left: -24px;
        transition: all 0.4s ease;
        box-shadow: 0 5px 5px rgba(0, 0, 0, 0.125), 0 5px 5px rgba(0, 0, 0, 0.2);
    }

    .pinForm header {
        background: #6f42c1;
        color: #fff;
        font-size: 2.5rem;
        height: 56px;
        width: 56px;
        border-radius: 50%;
        align-items: center;
        justify-content: center;
        display: flex;
    }

    .pinForm h4 {
        font-size: 1.2rem;
        font-weight: 500;
    }

    .pinForm .input_field {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .pinForm .input_field input {
        width: 42px;
        height: 45px;
        outline: none;
        border-radius: 4px;
        text-align: center;
        font-size: 1.125rem;
        font-weight: 500;
    }

    .pinForm .input_field input::-webkit-inner-spin-button,
    .pinForm .input_field input::-webkit-outer-spin-button {
        display: none;
    }

    .pinForm button {
        padding: 8px 24px;
        border: none;
        border-radius: 4px;
        background-color: #6f42c1;
        color: #f5f5f5;
        cursor: pointer;
        margin-top: 12px;
        text-align: center;
        transition: all 0.3s ease;
        pointer-events: none;
    }

    .pinForm button.active {
        pointer-events: auto;
    }

    .pinForm button:hover {
        background: #6039a9;
        color: #fff;
    }

    .pinForm button:active {
        transform: scale(0.95);
    }
    </style>
</head>

<body>
    <div class="container">
        <?php include 'adminDashboard.php';?>

        <div class="pinForm">
            <header><i class='bx bxs-check-shield'></i></header>
            <h4>Enter Account Pin</h4>
            <div class="input_field">
                <input type="number" class="pinInput" name="pin1" id="" length="1">
                <input type="number" class="pinInput" name="pin2" id="" length="1" disabled>
                <input type="number" class="pinInput" name="pin3" id="" length="1" disabled>
                <input type="number" class="pinInput" name="pin4" id="" length="1" disabled>
            </div>
            <button class="pinInputBtn" name="withdraw">Verify Pin</button>
        </div>
    </div>
    <script>
    <?php include '../pages.js' ?>
    </script>
</body>

</html>