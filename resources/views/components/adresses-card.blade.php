<!-- Form Row-->
<div class="row gx-3 mb-3">
    <!-- Form Group (first name)-->
    <div class="col-md-12">
        <label class="small mb-1" for="identifier">{{__("Nom complet ou nom de l'entreprise")}}<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
        <input {!! $form ? "form=$form" : "" !!} class="form-control" id="first_name" type="text" placeholder="" value="{{ old('address.identifier') ? old('address.identifier') : $address->identifier ?? '' }}" name="address[identifier]">
        @error('address.identifier')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <!-- Form Group (last name)-->
</div>
<div class="row gx-3 mb-3">
    <!-- Form Group (first name)-->
    <div class="col-md-6">
        <label class="small mb-1" for="address">{{__("Adresse")}}<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
        <input {!! $form ? "form=$form" : "" !!} class="form-control" id="address" type="text" placeholder="" value="{{ old('address.address') ? old('address.address') : $address->address ?? '' }}" name="address[address]">
        @error('address.address')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <!-- Form Group (last name)-->
    <div class="col-md-6">
        <label class="small mb-1" for="address_complement">{{__("Complément d'adresse")}}</label>
        <input {!! $form ? "form=$form" : "" !!} class="form-control" id="address_complement" type="text" placeholder="" value="{{ old('address.address_complement') ? old('address.address_complement') : $address->address_complement ?? ''}}" name="address[address_complement]">
    </div>
</div>
<div class="row gx-3 mb-3">
    <!-- Form Group (first name)-->
    <div class="col-md-6">
        <label class="small mb-1" for="postal_code">{{__("Code postal")}}<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
        <input {!! $form ? "form=$form" : "" !!} class="form-control" id="postal_code" type="text" placeholder="" value="{{ old('address.postal_code') ? old('address.postal_code') : $address->postal_code ?? '' }}" name="address[postal_code]">
        @error('address.postal_code')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <!-- Form Group (last name)-->
    <div class="col-md-6">
        <label class="small mb-1" for="city">{{__("Ville")}}<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
        <input {!! $form ? "form=$form" : "" !!} class="form-control" id="city" type="text" placeholder="" value="{{ old('address.city') ? old('address.city') : $address->city ?? '' }}" name="address[city]">
        @error('address.city')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="row gx-3 mb-3">
    <!-- Form Group (first name)-->
    <div class="col-md-6">
        <label class="small mb-1" for="state">{{__("État/Province")}}</label>
        <input {!! $form ? "form=$form" : "" !!} class="form-control" id="state" type="text" placeholder="" value="{{ old('address.state') ? old('address.state') : $address->state ?? '' }}" name="address[state]">
        @error('address.state')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <!-- Form Group (last name)-->
    <div class="col-md-6">
        <label class="small mb-1" for="country">{{__("Pays")}}</label>
        <input {!! $form ? "form=$form" : "" !!} class="form-control" id="country" type="text" placeholder="" value="{{ old('address.country') ? old('address.country') : $address->country ?? '' }}" name="address[country]">
        @error('address.country')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="row gx-3 mb-3">
    <div class="col-md-6">
        <label class="small mb-1" for="phone_number">{{__("Numéro de téléphone")}}</label>
        <input {!! $form ? "form=$form" : "" !!} class="form-control" id="phone_number" type="text" placeholder="" value="{{ old('address.phone_number') ? old('address.phone_number') : $address->phone_number ?? '' }}" name="address[phone_number]">
        @error('address.phone_number')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
