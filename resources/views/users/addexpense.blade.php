<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


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


    </head>
    <body class="antialiased">
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@php
    $userId = auth()->id();
@endphp

    <h1 class="mb-4">Add Expense Page</h1>
    <form  method="POST" action="{{ route('users.expenses.store', ['userId' => $userId]) }}" enctype="multipart/form-data">
        @csrf
      <!-- Title -->
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title">
      </div>
      <!-- Description -->
      <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description"></textarea>
      </div>
      <!-- Type of Money (Income/Expense) -->
      <div class="form-group">
        <label>Type of Money</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="moneyType" id="income" value="income">
          <label class="form-check-label" for="income">Income</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="moneyType" id="expense" value="expense">
          <label class="form-check-label" for="expense">Expense</label>
        </div>
      </div>
      <!-- Amount -->
      <div class="form-group">
        <label for="amount">Amount</label>
        <input type="number" class="form-control" id="amount" name="amount">
      </div>
      <!-- Date -->
      <div class="form-group">
        <label for="date">Selecting the Date</label>
        <input type="date" class="form-control" id="date" name="date">
      </div>
      <div class="form-group">
        <label for="pdf">Upload the file</label>
        <input type="file" id="fileInput" name="attachment" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" multiple>
        <div id="preview"></div>
    </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <!-- Datepicker Initialization -->





  <script>
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






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   </body>
</html>


