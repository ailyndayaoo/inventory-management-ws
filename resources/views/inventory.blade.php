<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
        }

        .content {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            flex: 1 1 30%; /* Keep form compact */
        }

        .inventory-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            flex: 1 1 65%; /* Make inventory list take more space */
            max-height: 500px; /* Set max height to make it scrollable */
            overflow-y: auto; /* Enable vertical scrolling */
        }

        .form-container h2,
        .inventory-container h2 {
            margin-bottom: 20px;
            font-size: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .add-btn {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
        }

        .add-btn:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px; 
            font-weight: bold; 
            text-align: left; 
        }

        th:hover {
            background-color: #0056b3;
        }

        .edit-btn,
        .delete-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
        }

        .delete-btn {
            background-color: #dc3545;
            margin-right: 5px;
        }

        .edit-btn:hover {
            background-color: #0056b3;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        @media screen and (max-width: 768px) {
            .form-container,
            .inventory-container {
                flex: 1 1 100%;
            }

            h1 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Inventory Management</h1>

        @if(session('success'))
            <p class="success-message">{{ session('success') }}</p>
        @endif

        <div class="content">
            <!-- Left Side: Add New Item Form -->
            <div class="form-container">
                <h2>Add New Item</h2>
                <form action="{{ route('inventory.store') }}" method="POST">
                    @csrf
                    <label for="name">Item Name</label>
                    <input type="text" name="name" required>

                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" required>

                    <label for="item_cost">Item Cost</label>
                    <input type="number" name="item_cost" step="0.01" required>

                    <label for="price">Price</label>
                    <input type="number" name="price" step="0.01" required>

                    <button type="submit" class="add-btn">Add Item</button>
                </form>
            </div>

            <!-- Right Side: Inventory List -->
            <div class="inventory-container">
                <h2>Inventory List</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Item Cost</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>₱{{ number_format($item->item_cost, 2) }}</td>
                                <td>₱{{ number_format($item->price, 2) }}</td>
                                <td>
                                    <form action="{{ route('inventory.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('inventory.edit', $item->id) }}" class="edit-btn">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
