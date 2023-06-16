<!-- Votre formulaire de création de rôle -->
<form method="POST" action="{{ route('roles.store') }}">
    @csrf

    <div>
        <label for="name">Nom du rôle</label>
        <input type="text" id="name" name="name" required>
    </div>

    <button type="submit">Créer</button>
</form>
