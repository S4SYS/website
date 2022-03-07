class Requisicao
{
    $content;

    init($content)
    {
        this.$content = $content;        
        this.setContent();
    }

    setContent()
    {
        let self = this;        
        $.get('../api.php', { acao : 'get_requisicoes'}, response => {          
            self.$content
            .html(self.getCard().join(''))
            .find('table')
            .find('tbody')
            .html(self.getBodyContent(response.data).join(''));

            self.$content.find('table').DataTable({responsive : true});
          
        }, 'json');
    }
    
    getBodyContent(dados)
    {
        return dados.map(row => { 
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
        });
    }

    getCard()
    {
        return [
            ...this.getCardHeader(),
            ...this.getCardBody(),
        ];
    }

    getCardHeader()
    {
        return [
            '<div class="card-header py-3">',
            '<h6 class="m-0 font-weight-bold text-primary">',
            'Lista de Requisi&ccedil;&otilde;es',
            '</h6>',
            '</div>'
        ];
    }

    getCardBody()
    {
        return [
            '<div class="card-body">',
            '<div class="table-responsive">',
            ...this.getTable(),
            '</div>',
            '</div>'
        ];
    }

    getTable()
    {
        return [
            //'<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">',
            '<table class="table table-bordered table-responsive" id="dataTable">',
            ...this.getTableHead(),
            ...this.getTableBody(),
            '</table>'
        ];
    }

    getTableHead()
    {
        let titles = [
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

        let columns = titles.map(col => { return `<th>${col}</th>`; });
        
        return ['<thead>', '<tr>', ...columns, '</tr>', '</thead>'];
    }
    
    
    getTableBody()
    {
        return [
            '<tbody>',
            '</tbody>'
        ];
    }    
}