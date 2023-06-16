<!-- Votre formulaire d'affectation des rôles -->
<form method="POST" action="{{ route('roles.storeRole', $role) }}">
    @csrf

    <div>
        <label for="users">Utilisateurs</label>
        <select id="users" name="users[]" multiple required>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit">Affecter</button>
</form>
