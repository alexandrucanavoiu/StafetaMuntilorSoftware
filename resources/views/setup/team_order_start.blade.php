<div class="modal fade" id="TeamOrderStart" tabindex="-1" role="dialog" aria-labelledby="TeamOrderStart" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Configurare Ordine Start Echipe</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div>Va rugam sa alegeti ordinea generarii startului pentru categorii:</div>
                                    <div class="alert alert-danger print-error-msg" style="display:none">
                                        <span>Există erori la validarea formularului!</span>
                                    </div>
                                    <div class="help-block text-danger print-error" id="form_corruption-error" style="display:none"><ul role="alert"></ul></div>
                                    <br />
                                    <form>
                                        @csrf
                                        <div class="form-body">

                                            <div class="row">
                                                @foreach ($categories as $category)
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <span>Categoria {{ $category->name }}(<span class="field-required">*</span>)</span>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <select class="form-control category_{{ $category->id }}" aria-required="true" id="category_{{ $category->id }}" name="category_{{ $category->id }}">
                                                                @foreach ($categories as $category_selected)
                                                                <option value="{{ $category_selected->id }}" @if($category_selected->order_start == $category->id) selected @endif>{{ $category_selected->id }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="help-block text-danger print-error" id="category_{{ $category->id }}-error" style="display:none"><ul role="alert"></ul></div>
                                                            <p><small class="text-muted"></small></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                <div class="col-12">
                                                <br />
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <span>Ora de start 0: (<span class="field-required">*</span>)</span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="input-group mb-4">
                                                                <input class="form-control order_date_start" id="order_date_start" type="text" name="order_date_start" placeholder="hh:mm:ss" value="{{ $team_order_start->order_date_start }}" required>
                                                                <div class="help-block text-danger print-error" id="order_date_start-error" style="display:none"><ul role="alert"></ul></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <span>Intervalul de minute intre echipe:(<span class="field-required">*</span>)</span>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <select class="form-control order_start_minutes" aria-required="true" id="order_start_minutes" name="order_start_minutes">
                                                                @foreach (range(1, 60) as $interval)
                                                                <option value="{{ $interval }}" @if($team_order_start->order_start_minutes == $interval) selected @endif>{{ $interval }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="help-block text-danger print-error" id="order_start_minutes-error" style="display:none"><ul role="alert"></ul></div>
                                                            <p><small class="text-muted"></small></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 offset-md-4 pt-50">
                                                    <button type="button" class="btn btn-primary me-1 mr-1 mb-1" type="reset" data-bs-dismiss="modal" aria-label="Close">Inchide</button>
                                                    <button type="submit" class="js--team-order-start-update btn btn-success mr-1 mb-1" data-stageid="{{ $stageid }}">Actualizeaza</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {

$("#order_date_start").inputmask("99:99:99",{ "placeholder": "0" });

});
</script>