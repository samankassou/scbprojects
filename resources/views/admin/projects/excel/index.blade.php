<style>
    #projects{
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
    }
    #projects td, #projects th{
        border: 1px solid #000;
        padding: 8px;
    }
    #projects tr:nth-child(even){background-color: #f2f2f2;}
    #projets th{
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }
</style>
<table id="projects" style="font-family: Arial, Helvetica, sans-serif; border-collapse: collapse; border: 1px solid #000;">
    <thead>
        <tr style="border: 1px solid #000">
            <th>#</th>
            <th>Reférence</th>
            <th>Nom</th>
            <th>Description</th>
            <th>AMOA</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($projects as $project)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $project->reference }}</td>
                <td>{{ $project->name }}</td>
                <td>{{ $project->description }}</td>
                <td>{{ $project->amoa }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align: center">Aucun projet enregistré</td>
            </tr>
        @endforelse
    </tbody>
</table>