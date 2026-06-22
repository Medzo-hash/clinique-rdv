<x-app-layout>
    <style>
        .form-page { max-width: 800px; margin: 0 auto; padding: 40px 24px; }

        .form-header { margin-bottom: 32px; }
        .form-header h1 { font-size: 26px; font-weight: 800; color: #0f172a; margin-bottom: 6px; }
        .form-header p { font-size: 14px; color: #6b7280; }

        .form-card {
            background: white; border-radius: 16px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.07);
            border: 1px solid #f1f5f9; overflow: hidden;
        }
        .form-section {
            padding: 28px 32px; border-bottom: 1px solid #f8fafc;
        }
        .form-section:last-child { border-bottom: none; }
        .form-section-title {
            font-size: 14px; font-weight: 700; color: #0f172a;
            margin-bottom: 20px; display: flex; align-items: center; gap: 8px;
        }
        .form-section-title span {
            width: 28px; height: 28px; border-radius: 8px;
            background: #eff6ff; display: flex; align-items: center;
            justify-content: center; font-size: 14px;
        }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-grid-1 { grid-template-columns: 1fr; }

        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-label {
            font-size: 13px; font-weight: 600; color: #374151;
        }
        .form-control {
            padding: 11px 14px; border: 1.5px solid #e2e8f0;
            border-radius: 10px; font-size: 14px; outline: none;
            transition: all 0.2s; font-family: 'Segoe UI', sans-serif;
            color: #0f172a; background: white;
        }
        .form-control:focus {
            border-color: #1a56db;
            box-shadow: 0 0 0 3px rgba(26,86,219,0.1);
        }
        select.form-control { cursor: pointer; }
        textarea.form-control { resize: vertical; min-height: 100px; }
        .form-error { font-size: 12px; color: #dc2626; margin-top: 2px; }

        /* MÉDECIN CARDS */
        .medecin-grid {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;
        }
        .medecin-option {
            border: 2px solid #e2e8f0; border-radius: 12px; padding: 16px;
            cursor: pointer; transition: all 0.2s; text-align: center;
            position: relative;
        }
        .medecin-option:hover { border-color: #1a56db; background: #eff6ff; }
        .medecin-option.selected { border-color: #1a56db; background: #eff6ff; }
        .medecin-option input[type="radio"] {
            position: absolute; opacity: 0; width: 0; height: 0;
        }
        .medecin-avatar {
            width: 48px; height: 48px; border-radius: 50%;
            background: #1a56db; color: white;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; font-weight: 700; margin: 0 auto 10px;
        }
        .medecin-name { font-size: 13px; font-weight: 700; color: #0f172a; }
        .medecin-spec { font-size: 11px; color: #6b7280; margin-top: 3px; }
        .medecin-check {
            position: absolute; top: 8px; right: 8px;
            width: 20px; height: 20px; border-radius: 50%;
            background: #1a56db; color: white;
            display: none; align-items: center; justify-content: center;
            font-size: 11px;
        }
        .medecin-option.selected .medecin-check { display: flex; }

        /* CRENEAUX */
        .creneaux-grid {
            display: grid; grid-template-columns: repeat(6, 1fr); gap: 8px;
        }
        .creneau {
            padding: 10px 6px; text-align: center; border-radius: 8px;
            border: 1.5px solid #e2e8f0; font-size: 13px; font-weight: 600;
            cursor: pointer; transition: all 0.2s; color: #374151;
        }
        .creneau:hover { border-color: #1a56db; color: #1a56db; background: #eff6ff; }
        .creneau.selected { background: #1a56db; color: white; border-color: #1a56db; }

        /* FOOTER */
        .form-footer {
            padding: 24px 32px; background: #f8fafc;
            display: flex; justify-content: space-between; align-items: center;
        }
        .btn-cancel {
            padding: 11px 24px; border-radius: 10px;
            border: 1.5px solid #e2e8f0; background: white;
            font-size: 14px; font-weight: 600; color: #6b7280;
            text-decoration: none; transition: all 0.2s;
        }
        .btn-cancel:hover { border-color: #94a3b8; color: #374151; }
        .btn-submit {
            padding: 12px 32px; border-radius: 10px;
            background: #1a56db; color: white; border: none;
            font-size: 14px; font-weight: 700; cursor: pointer;
            transition: all 0.2s; font-family: 'Segoe UI', sans-serif;
        }
        .btn-submit:hover { background: #1e3a8a; transform: translateY(-1px); }

        @media (max-width: 768px) {
            .form-grid { grid-template-columns: 1fr; }
            .medecin-grid { grid-template-columns: repeat(2, 1fr); }
            .creneaux-grid { grid-template-columns: repeat(4, 1fr); }
        }
    </style>

    <div class="form-page">
        <div class="form-header">
            <h1>📅 Prendre un rendez-vous</h1>
            <p>Choisissez votre médecin, la date et l'heure qui vous conviennent</p>
        </div>

        @if ($errors->any())
            <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:14px 18px;margin-bottom:20px;color:#b91c1c;font-size:14px;">
                ⚠️ Veuillez corriger les erreurs suivantes :
                <ul style="margin-top:8px;padding-left:20px">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('rendezvous.store') }}">
            @csrf
            <div class="form-card">

                {{-- SECTION 1 : MÉDECIN --}}
                <div class="form-section">
                    <div class="form-section-title">
                        <span>👨‍⚕️</span> Choisissez un médecin
                    </div>
                    <div class="medecin-grid">
                        @foreach ($medecins as $medecin)
                            <label class="medecin-option {{ old('medecin_id') == $medecin->id ? 'selected' : '' }}" onclick="selectMedecin(this)">
                                <input type="radio" name="medecin_id" value="{{ $medecin->id }}" {{ old('medecin_id') == $medecin->id ? 'checked' : '' }} required>
                                <div class="medecin-check">✓</div>
                                <div class="medecin-avatar">{{ strtoupper(substr($medecin->name, 0, 2)) }}</div>
                                <div class="medecin-name">Dr. {{ $medecin->name }}</div>
                                <div class="medecin-spec">{{ $medecin->specialite ?? 'Généraliste' }}</div>
                            </label>
                        @endforeach
                    </div>
                    @error('medecin_id') <p class="form-error" style="margin-top:12px">⚠️ {{ $message }}</p> @enderror
                </div>

                {{-- SECTION 2 : DATE --}}
                <div class="form-section">
                    <div class="form-section-title">
                        <span>📅</span> Choisissez une date
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Date de consultation</label>
                            <input type="date" name="date" class="form-control"
                                   value="{{ old('date') }}" min="{{ date('Y-m-d') }}" required>
                            @error('date') <p class="form-error">⚠️ {{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Heure (ou choisissez un créneau ci-dessous)</label>
                            <input type="time" name="heure" id="heureInput" class="form-control"
                                   value="{{ old('heure') }}" required>
                            @error('heure') <p class="form-error">⚠️ {{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div style="margin-top:20px">
                        <label class="form-label" style="margin-bottom:10px;display:block">⏰ Créneaux suggérés</label>
                        <div class="creneaux-grid">
                            @foreach (['08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','14:00','14:30','15:00','15:30'] as $h)
                                <div class="creneau" onclick="selectCreneau(this, '{{ $h }}')">{{ $h }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- SECTION 3 : MOTIF --}}
                <div class="form-section">
                    <div class="form-section-title">
                        <span>📝</span> Motif de consultation
                    </div>
                    <div class="form-group">
                        <label class="form-label">Décrivez brièvement la raison de votre consultation (optionnel)</label>
                        <textarea name="motif" class="form-control"
                                  placeholder="Ex: Douleurs abdominales depuis 3 jours...">{{ old('motif') }}</textarea>
                        @error('motif') <p class="form-error">⚠️ {{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- FOOTER --}}
                <div class="form-footer">
                    <a href="{{ route('rendezvous.index') }}" class="btn-cancel">← Annuler</a>
                    <button type="submit" class="btn-submit">
                        ✅ Confirmer le rendez-vous
                    </button>
                </div>

            </div>
        </form>
    </div>

    <script>
        function selectMedecin(label) {
            document.querySelectorAll('.medecin-option').forEach(l => l.classList.remove('selected'));
            label.classList.add('selected');
            label.querySelector('input[type="radio"]').checked = true;
        }

        function selectCreneau(el, heure) {
            document.querySelectorAll('.creneau').forEach(c => c.classList.remove('selected'));
            el.classList.add('selected');
            document.getElementById('heureInput').value = heure;
        }
    </script>
</x-app-layout>