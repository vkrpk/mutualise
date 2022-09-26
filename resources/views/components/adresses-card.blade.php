<!-- Form Row-->
<div class="row gx-3 mb-3">
    <!-- Form Group (first name)-->
    <div class="col-md-12">
        <label class="small mb-1" for="identifier">Nom complet ou nom de l'entreprise<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
        <input {!! $form ? "form=$form" : "" !!} class="form-control" id="first_name" type="text" placeholder="" value="{{ old('identifier') ? old('identifier') : $address->identifier ?? '' }}" name="identifier">
    </div>
    <!-- Form Group (last name)-->
</div>
<div class="row gx-3 mb-3">
    <!-- Form Group (first name)-->
    <div class="col-md-6">
        <label class="small mb-1" for="address">{{__("Adresse")}}<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
        <input {!! $form ? "form=$form" : "" !!} class="form-control" id="address" type="text" placeholder="" value="{{ old('address') ? old('address') : $address->address ?? '' }}" name="address">
        @error('address')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <!-- Form Group (last name)-->
    <div class="col-md-6">
        <label class="small mb-1" for="address_complement">{{__("Complément d'adresse")}}</label>
        <input {!! $form ? "form=$form" : "" !!} class="form-control" id="address_complement" type="text" placeholder="" value="{{ old('address_complement') ? old('address_complement') : $address->address_complement ?? ''}}" name="address_complement">
    </div>
</div>
<div class="row gx-3 mb-3">
    <!-- Form Group (first name)-->
    <div class="col-md-6">
        <label class="small mb-1" for="postal_code">{{__("Code postal")}}<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
        <input {!! $form ? "form=$form" : "" !!} class="form-control" id="postal_code" type="text" placeholder="" value="{{ old('postal_code') ? old('postal_code') : $address->postal_code ?? '' }}" name="postal_code">
        @error('postal_code')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <!-- Form Group (last name)-->
    <div class="col-md-6">
        <label class="small mb-1" for="city">{{__("Ville")}}<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
        <input {!! $form ? "form=$form" : "" !!} class="form-control" id="city" type="text" placeholder="" value="{{ old('city') ? old('city') : $address->city ?? '' }}" name="city">
        @error('city')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="row gx-3 mb-3">
    <!-- Form Group (first name)-->
    <div class="col-md-6">
        <label class="small mb-1" for="state">{{__("État/Province")}}</label>
        <input {!! $form ? "form=$form" : "" !!} class="form-control" id="state" type="text" placeholder="" value="{{ old('state') ? old('state') : $address->state ?? '' }}" name="state">
    </div>
    <!-- Form Group (last name)-->
    <div class="col-md-6">
        <label class="small mb-1" for="country">{{__("Pays")}}</label>
        <input {!! $form ? "form=$form" : "" !!} class="form-control" id="country" type="text" placeholder="" value="{{ old('country') ? old('country') : $address->country ?? '' }}" name="country">
    </div>
</div>
<div class="row gx-3 mb-3">
    <div class="col-md-6">
        <label class="small mb-1" for="phone_number">{{__("Numéro de téléphone")}}</label>
        <input {!! $form ? "form=$form" : "" !!} class="form-control" id="phone_number" type="text" placeholder="" value="{{ old('phone_number') ? old('phone_number') : $address->phone_number ?? '' }}" name="phone_number">
    </div>
</div>
