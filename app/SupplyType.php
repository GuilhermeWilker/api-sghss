<?php

namespace App;

enum SupplyType: string
{
    case MEDICAMENTO = 'medicamento';
    case EQUIPAMENTO_MEDICO = 'equipamento_medico';
    case MATERIAL_HOSPITALAR = 'material_hospitalar';
    case LIMPEZA = 'limpeza';
    case ESCRITORIO = 'escritorio';
    case ALIMENTACAO = 'alimentacao';
    case TECNOLOGIA = 'tecnologia';
}
