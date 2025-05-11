<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Inventory Item</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 500px;
            width: 90%;
            margin: 40px auto;
            background-color: #fff;
            padding: 25px 20px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 22px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        label {
            font-weight: 600;
            color: #444;
        }

        input[type="text"],
        input[type="number"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .update-btn {
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-top: 10px;
        }

        .update-btn:hover {
            background-color: #0056b3;
        }

        .cancel-btn {
            display: inline-block;
            padding: 10px;
            background-color: #6c757d;
            color: white;
            border-radius: 6px;
            text-align: center;
            text-decoration: none;
            transition: background 0.3s ease;
            margin-top: 8px;
        }

        .cancel-btn:hover {
            background-color: #5a6268;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .error-message ul {
            margin: 0;
            padding-left: 20px;
        }

        .error-message li {
            list-style-type: disc;
        }

        @media screen and (max-width: 480px) {
            h1 {
                font-size: 18px;
            }

            .update-btn,
            .cancel-btn {
                font-size: 14px;
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Inventory Item</h1>

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('inventory.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="name">Item Name</label>
            <input type="text" name="name" value="{{ $item->name }}" required>

            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" value="{{ $item->quantity }}" required>

            <label for="item_cost">Item Cost</label>
            <input type="number" step="0.01" name="item_cost" value="{{ $item->item_cost }}" required>

            <label for="price">Price</label>
            <input type="number" step="0.01" name="price" value="{{ $item->price }}" required>

            <button type="submit" class="update-btn">Update Item</button>
            <a href="{{ route('inventory.index') }}" class="cancel-btn">Cancel</a>
        </form>
    </div>
</body>
</html>
