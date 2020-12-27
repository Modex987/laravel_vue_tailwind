@csrf
<div class="mb-3">
    <label for="name" class="form-label">full name</label>
    <input type="text" name='name' class="form-control" id="name" value="{{ old('name') ?? $customer->name }}">
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" name='email' class="form-control" id="email" value="{{ old('email') ?? $customer->email }}">
</div>
<div class="mb-3">
    <label for="status" class="form-label">Select Status</label>
    <select class="form-control" name="status" aria-label="Default select example" id="status">
        <option selected disabled>Choose...</option>
        @foreach ($customer->statusOptions as $key => $val)
            <option value="{{ $key }}" {{ $customer->status === $val ? 'selected' : '' }} {{ old('status') === $key ? 'selected' : '' }} >{{ $val }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="company" class="form-label">Select Company</label>
    <select class="form-control" name="company_id" aria-label="Default select example" id="company">
        <option selected disabled>Choose...</option>
        <?php foreach ($companies as $company) : ?>
        <option value="<?= $company->id ?>" {{ $customer->company_id === $company->id ? 'selected' : '' }} {{ old('company_id') === $company->id ? 'selected' : '' }}><?= $company->name ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="mb-3">
    <label for="profile_img" class="form-label">Choose Profile Img</label> <br>
    <input type="file" name="profile_img" id="profile_img">
</div>
<button type="submit" class="btn btn-primary mt-3">Submit</button>