<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Modifica il tuo piatto</h1>

    <form action="{{ route('admin.dishes.update', ['dish' => $dish->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nome del piatto:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $dish->name) }}">
        </div>

        <div class="mb-3">
            <label for="cover" class="form-label">Immagine:</label>
            <input type="text" class="form-control" id="cover" name="cover" value="{{ old('cover', $dish->cover) }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione piatto:</label>
            <textarea name="description" id="description" cols="30" rows="10">{{ old('description', $dish->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Prezzo:</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $dish->price) }}">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_visible">
            <label class="form-check-label" for="is_visible">Presente nel menu</label>
        </div>

        <input type="submit" class="btn btn-primary" value="Salva">
      </form>
</body>
</html>