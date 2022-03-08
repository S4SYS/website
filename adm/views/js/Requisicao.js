class Requisicao extends Lista {
    
    $content;

    init($content) 
    {
        this.cardTitle       = 'Lista de Requisi&ccedil;&otilde;es';
        this.tableHeadTitles = this.getTitles();
        this.actionName      = 'get_requisicoes';
        this.requestBody     = this.getRequestBody();
        this.$content        = $content;
        this.setContent();
    }

    getRequestBody() 
    {
        return row => {
            return `<tr>
                    <td>${row.codigo}</td>
                    <td>${row.cpf}</td>
                    <td>${row.email}</td>
                    <td>${row.nome}</td>
                    <td>${row.telefone}</td>
                    <td>${row.nome_tipo_requisicao}</td>
                    <td>${row.pedido}</td>
                    <td>${row.nome_setor}</td>
                    <td>${row.created_at}</td>
                    <td>
                    <a href="../files/upload/${row.arquivo}" target="_blank">${row.arquivo}</a>
                    </td>
                    <td>${row.nome_status}</td>
                    </tr>`;
        }
    }

    getTitles() 
    {
        return [
            'C&oacute;digo',
            'CPF',
            'Email',
            'Nome',
            'Telefone',
            'Tipo',
            'Pedido',
            'Setor',
            'Data',
            'Arquivo',
            'Status'
        ];
    }
}