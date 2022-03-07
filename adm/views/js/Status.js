class Status {
    
    $content;

    init($content) 
    {
        this.$content = $content;
        this.setContent();
    }

    setContent() 
    {
        let self = this;
        $.get('../api.php', { acao: 'get_status' }, response => {
            self.$content
                .html(self.getCard().join(''))
                .find('table')
                .find('tbody')
                .html(self.getBodyContent(response.data).join(''));

            self.$content.find('table')
                .DataTable(
                    {
                        responsive: true,
                        dom: 'Bfrtip',
                        buttons: [
                            'colvis'
                        ]
                    }
                );

        }, 'json');
    }

    getBodyContent(dados) 
    {
        return dados.map(row => {
            return `<tr>
                        <td>${row.id}</td>
                        <td>${row.nome}</td>
                        <td>${row.created_at}</td>
                        <td>${row.updated_at}</td>
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
            'Lista de Status',
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
            '<table class="table table-bordered display responsive nowrap" id="dataTable" width="100%">',
            ...this.getTableHead(),
            ...this.getTableBody(),
            '</table>'
        ];
    }

    getTableHead() 
    {
        let titles = [
            'Id',
            'Nome',
            'Data de cria&ccedil;&atilde;o',
            'Data de atualiza&ccedil;&atilde;o'            
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