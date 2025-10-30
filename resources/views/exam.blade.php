<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Resultado do Eletrocardiograma de Repouso</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-gray-900 font-sans max-w-3xl mx-auto border border-gray-300 p-8">

    <!-- Cabeçalho -->
    <header class="flex items-center justify-between border-b border-gray-300 pb-4">
        <div>
            <h1 class="text-2xl font-bold text-red-600">SGHHS</h1>
            <p class="text-sm text-gray-700 leading-tight">CLÍNICA DE MEDICINA GERAL E ESPECIALIZADA</p>
        </div>
        <div class="text-right text-sm">
            <p class="font-semibold">Clínica Morsch</p>
            <p>Especialista em Telemedicina</p>
        </div>
    </header>

    <!-- Título principal -->
    <section class="text-center my-6">
        <h2 class="font-semibold text-lg border-b border-gray-400 inline-block pb-1">
            RESULTADO DO {...}
        </h2>
    </section>

    <!-- Corpo do resultado -->
    <section class="text-sm leading-relaxed mb-6">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident?</p>
        <p>Lorem ipsum dolor sit amet consectetur.</p>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam eaque sequi harum.</p>
        <p>Lorem ipsum dolor sit</p>
    </section>

    <!-- Dados do exame -->
    <section class="text-sm mb-8">
        <div class="grid grid-cols-2 gap-y-1">
            <p><strong>Clínica:</strong> POPULAR</p>
            <p><strong>Empresa solicitante:</strong> CLÍNICA POPULAR</p>
            <p><strong>Médico solicitante:</strong> Dr. Sílvio R. Fontes de Lima</p>
            <p><strong>Paciente:</strong> Raimundo Nonato Cosmo Belo</p>
            <p><strong>Data:</strong> {{ now()->toDateString() }}</p>
            <p><strong>Idade:</strong> 53 anos</p>
            <p><strong>Peso:</strong> 74kg</p>
            <p><strong>Pressão arterial:</strong> 120x74</p>
            <p><strong>Altura:</strong> 170cm</p>
        </div>
    </section>

    <!-- Assinatura -->
    <section class="text-center mt-10">
        <div class="inline-block">
            <p class="font-semibold text-sm">{NOME DO DOURTO}</p>
            <p class="text-xs">{specialidade}</p>
            <p class="text-xs">CRM-{...}</p>
        </div>
    </section>

    <!-- Rodapé -->
    <footer class="text-center mt-8 text-xs border-t border-gray-300 pt-3 text-gray-600">
        <p>Dr. José Aldair Morsch – Cardiologista – CRM: RS 20142</p>
        <p>Rua Porto Alegre, 380-302 – CEP 99700-000 – Centro de Erechim – SP</p>
        <p>Fone/Fax: (0xx54) 3321-3815 – E-mail: jamorsch@gmail.com</p>
    </footer>

</body>

</html>