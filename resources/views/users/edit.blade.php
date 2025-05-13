@extends('layouts.app')

@section('content')
<form action="{{ route('users.store') }}" method="POST">
  @csrf

  <!-- Name, Email, Password fields… -->

  <div class="mb-3">
    <label for="franchisee_id" class="form-label">Franchise</label>
    <multiselect name="franchisee_id" id="franchisee_id" class="form-multiselect @error('franchisee_id') is-invalid @enderror">
      <option value="">— Select Franchise —</option>
      @foreach($franchises as $fr)
        <option value="{{ $fr->id }}"
          {{ old('franchisee_id') == $fr->id ? 'selected' : '' }}>
          {{ $fr->name }}
        </option>
      @endforeach
    </multiselect>
    @error('franchisee_id')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <!-- Role field… -->

  <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection

