<form id="mapping" method="POST"  action="{{ url('load') }}" accept-charset="utf-8" enctype="multipart/form-data">
  @csrf
  <div class="container text-center">
    <div class="row">
      <div class="col align-self-center">
        <label for="inputs" class="form-label">Column Name</label>
        @foreach($headers as $header)
          <input class="form-control my-1" type="text" name="org_name" value="{{ $header->oryginal_name }}" aria-label="readonly input example" readonly>
        @endforeach
      </div>

      <div class="col align-self-center">
      <label for="selections" class="form-label">Map to </label>
        @foreach($headers as $org_header)
        <div>
          <select class="form-select my-1" name="mapCol_{{ $org_header->id }}" id="mapCol_{{ $org_header->id }}" aria-label="Header">
            <option disabled selected>-- Select --</option>
            @foreach($headers as $map_header)
              <option value="{{ $map_header->name }}">{{ $map_header->oryginal_name }}</option>
            @endforeach
          </select>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</form>
