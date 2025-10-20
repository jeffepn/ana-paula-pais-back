<div style="margin:0;padding:0;background-color:#FEFFFB;font-family:'Poppins',Arial,sans-serif;">
    <div style="max-width:600px;margin:0 auto;padding:32px 16px;background:#FEFFFB;">
        <div
            style="background:#fff;border-radius:16px;padding:40px 32px;box-shadow:0 2px 8px rgba(0,0,0,0.07);border:1.5px solid #E2E2E2;">
            <div style="text-align:center;margin-bottom:32px;">
                <span
                    style="display:block;color:#c89e4e;font-size:14px;text-transform:uppercase;font-weight:500;letter-spacing:0.04em;margin-bottom:10px;">
                    Nova Mensagem
                </span>
                <h5
                    style="font-family: 'Poppins', Arial, sans-serif; font-size: 20px; font-weight: 600; line-height: 1.4; color: #202020; text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 24px;">
                    Formulário de Contato @isset($content['slug']) - Informação do Imóvel @endisset
                </h5>
            </div>
            <div style="background:#F9FAF1;border-radius:8px;padding:32px 24px;margin-bottom:32px;">
                @isset($content['slug'])
                    <span
                        style="display: block; font-family: 'Poppins', Arial, sans-serif; font-size: 14px; font-weight: 500; line-height: 1.6; color: #c89e4e; text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 24px;">
                        Código do Imóvel : {{$content['slug']}}
                    </span>
                @endisset
                <div style="margin-bottom:24px;">
                    <label
                        style="display:block;color:#202020;font-size:13px;font-weight:500;text-transform:uppercase;letter-spacing:0.04em;margin-bottom:6px;">Nome</label>
                    <div style="color:#797978;font-size:15px;">{{$content['name']}}</div>
                </div>
                <div style="margin-bottom:24px;">
                    <label
                        style="display:block;color:#202020;font-size:13px;font-weight:500;text-transform:uppercase;letter-spacing:0.04em;margin-bottom:6px;">Email</label>
                    <div style="color:#797978;font-size:15px;">{{$content['email']}}</div>
                </div>
                @isset($content['phone'])
                    <div style="margin-bottom:24px;">
                        <label
                            style="display:block;color:#202020;font-size:13px;font-weight:500;text-transform:uppercase;letter-spacing:0.04em;margin-bottom:6px;">Telefone</label>
                        <div style="color:#797978;font-size:15px;">{{$content['phone']}}</div>
                    </div>
                @endisset
                <div style="margin-bottom:0;">
                    <label
                        style="display:block;color:#202020;font-size:13px;font-weight:500;text-transform:uppercase;letter-spacing:0.04em;margin-bottom:6px;">Mensagem</label>
                    <div style="color:#797978;font-size:15px;line-height:1.7;">{{$content['message']}}</div>
                </div>
            </div>
            <div style="text-align:center;margin-top:24px;padding-top:16px;border-top:1.5px solid #E2E2E2;">
                <p style="text-align:center;color:#9B9B9B;font-size:13px;margin:0;line-height:1.6;">
                    Esta mensagem foi enviada através do formulário de contato do site.<br>
                    <span style="color:#c89e4e;font-weight:600;">{{ config('app.name') }}</span>
                </p>
            </div>
        </div>
    </div>
</div>