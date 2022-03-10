class Violacao extends Lista {
    
    $content;

    init($content) 
    {
        this.cardTitle       = 'Lista de Viola&ccedil;&otilde;es';
        this.tableHeadTitles = this.getTitles();
        this.actionName      = 'get_violacoes';
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
                    <td>${row.descricao}</td>
                    <td>${row.created_at}</td>
                    <td>
                    <a href="../files/upload/${row.arquivo}" target="_blank">${row.arquivo}</a>
                    </td>
                    <td>${row.nome_status}</td>
                    <td>
                    <button data-hash="${window.location.hash}" 
                    onClick="${this.getActionModal()}" 
                    data-id="${row.id}" data-action="edit" 
                    class="edit d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                    Editar
                    </button>
                    <button data-hash="${window.location.hash}" 
                    onClick="${this.getActionModal()}" 
                    data-id="${row.id}" data-action="deactivate" 
                    class="deactivate d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                    Desativar
                    </button>
                    </td>
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
            'Viola&ccedil;&atilde;o',
            'Data',
            'Arquivo',
            'Status',
            'A&ccedil;&otilde;es'
        ];
    }
}
