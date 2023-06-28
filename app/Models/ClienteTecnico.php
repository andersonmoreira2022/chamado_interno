<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ClienteTecnico extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    protected $table = 'cliente_tecnicos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'cnpj_cpf',
        'circuito',
        'gerente',
        'velocidade',
        'link',
        'ip',
        'meio',
        'interface_a',
        'interface_b',
        'endereco_ponto_a',
        'estado',
        'cidade',
        'endereco_ponto_b',
        'estado_ponto_b',
        'cidade_ponto_b',
        'designacao',
        'pre_venda',
        'tipo_cliente',
        'id_operadora',
        'dt_abertura',
        'dt_previsao_inicial',
        'dt_instalacao',
        'dt_entregue_fin',
        'dias',
        'dias_situacao_pendencia_cliente',
        'situacao',
        'contrato',
        'vlr_mensal',
        'vlr_ativacao',
        'prazo_contrato',
        'vlr_total',
        'created_at',
        'visualizado',
        'fornecedor_cnpj_parceiro',
        'fornecedor_nome_parceiro',
        'fornecedor_email_suporte',
        'fornecedor_telefone_suporte',
        'fornecedor_tipo_link',
        'fornecedor_ip',
        'fornecedor_meio_entrega',
        'fornecedor_velocidade',
        'fornecedor_designacao_parceiro',
        'fornecedor_email_financeiro',
        'fornecedor_telefone_financeiro',
        'fornecedor_valor_mensalidade',
        'fornecedor_valor_instalacao',
        'fornecedor_data_vencimento_fatura',
        'fornecedor_data_vigencia_contrato',
        'fornecedor_data_assinatura_contrato',
        'fornecedor_observacoes',
        'fornecedor_data_prevista_instalacao',
        'fornecedor_data_agendamento_cliente',
        'fornecedor_data_agendamento_parceiro',
        'fornecedor_data_conclusao',
        'fornecedor_dados_tecnicos',
        'protecao',
        'prazo_data_limite_ativacao',
        'circuito_em_atrasado'
    ];

    public function clientes(){
        return $this->belongsTo(Cliente::class, 'cnpj_cpf');
    }

    public function operadora(){
        return $this->belongsTo(Operadora::class, 'id_operadora');
    }

}
