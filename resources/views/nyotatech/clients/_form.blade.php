@php
    $c = $client;
@endphp

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="company_name">Company name</label>
        <input class="form-control" id="company_name" name="company_name"
               value="{{ old('company_name', $c?->company_name) }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="contact_name">Contact name</label>
        <input class="form-control" id="contact_name" name="contact_name"
               value="{{ old('contact_name', $c?->contact_name) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label" for="email">Email</label>
        <input class="form-control" id="email" name="email" type="email"
               value="{{ old('email', $c?->email) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label" for="phone">Phone</label>
        <input class="form-control" id="phone" name="phone"
               value="{{ old('phone', $c?->phone) }}">
    </div>
    <div class="col-12">
        <label class="form-label" for="address_line">Address</label>
        <input class="form-control" id="address_line" name="address_line"
               value="{{ old('address_line', $c?->address_line) }}">
    </div>
    <div class="col-12">
        <label class="form-label" for="notes">Notes</label>
        <textarea class="form-control" id="notes" name="notes" rows="4">{{ old('notes', $c?->notes) }}</textarea>
    </div>
</div>
