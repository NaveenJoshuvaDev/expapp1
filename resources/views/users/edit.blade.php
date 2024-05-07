<!-- users.edit.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Expense</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<style>
    #preview {
        display: flex;
        flex-wrap: wrap;
    }
    .file-preview {
        margin: 10px;
    }
    .file-preview img {
        max-width: 50px; /* Adjust the maximum width of the icon */
        max-height: 50px; /* Adjust the maximum height of the icon */
    }
</style>
<body>

<div class="container">
    <h1>Edit Expense</h1>
    <form action="{{ route('expenses.update', ['id' => $expense->id]) }}" method="POST"  enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Assuming you are using PUT method for update -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $expense->Title }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description">{{ $expense->Description }}</textarea>
        </div>
        <div class="form-group">
            <label>Type of Money</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="type" id="income" value="income" {{ $expense->Type == 'income' ? 'checked' : '' }}>
                <label class="form-check-label" for="income">Income</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="type" id="expense" value="expense" {{ $expense->Type == 'expense' ? 'checked' : '' }}>
                <label class="form-check-label" for="expense">Expense</label>
            </div>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="text" class="form-control" id="amount" name="amount" value="{{ $expense->Amount }}">
        </div>

        {{-- <div class="form-group">
            <label for="pdf">Upload the file</label>
            <input type="file" id="fileInput" name="attachment" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg">
            <div id="preview"></div>
        </div> --}}

        <div class="form-group">
            <label for="pdf">Upload New File</label>
            <input type="file" id="fileInput" name="attachment" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg">
            <div id="preview"></div>
            @if ($expense->Document)
                <p>Current File: <a href="{{ asset('storage/expense_attachments/' . $expense->Document) }}">{{ $expense->Document }}</a></p>
            @else
                <p>No file uploaded.</p>
            @endif
        </div>

        {{-- <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $expense->Date }}">
        </div> --}}
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="text" class="form-control" id="date" name="date">
        </div>
        <!-- Add more fields as needed -->

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script>
    var expenseDate = "{{ $expense->Date }}";
    console.log(expenseDate);
      // Get the expense date value


// Convert the date to a format suitable for the date input field (YYYY-MM-DD)
var formattedDate = new Date(expenseDate).toISOString().split('T')[0];

// Set the value of the date input field
document.getElementById('date').value = formattedDate;
const fileInput = document.getElementById('fileInput');
    const preview = document.getElementById('preview');

    fileInput.addEventListener('change', function() {
        preview.innerHTML = '';
        const files = Array.from(this.files);

        files.forEach(file => {
            const filePreview = document.createElement('div');
            filePreview.className = 'file-preview';
            const fileType = file.type.split('/')[1];
            filePreview.innerHTML = `<img src="/icons/${fileType}.png" alt="${fileType} icon">`;
            preview.appendChild(filePreview);
        });
    });

</script>

<script>

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
