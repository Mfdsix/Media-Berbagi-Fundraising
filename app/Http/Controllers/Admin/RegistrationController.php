<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Funding;
use App\Models\InstantProgram;
use App\Models\ProjectCategory;
use Auth;
use Storage;

class RegistrationController extends Controller
{
    public function index()
    {
        $datas = Project::where('type', 'registration')
            ->where('status', 1)
            ->paginate(15);

        foreach ($datas as $key => $value) {
            if ($value->date_target == null && $value->nominal_target == null) {
                $value->date_target = '∞';
                $value->nominal_target = '∞';
            } else {
                // $value->date_target = $this->date_to_idn($value->date_target);
                // $value->date_target = $this->date_to_idn($value->date_target);
                $value->nominal_target = 'Rp ' . str_replace(',', '.', number_format($value->nominal_target));
            }
        }


        $istant = [
            'key' => 'sedekah',
            'title' => 'Sedekah',
            'donations' => Funding::where('project_id', 0)
                ->where('fund_type', 'sedekah')
                ->where('status', 'paid')
                ->sum('nominal'),
            'is_active' => InstantProgram::where('program', 'sedekah')
                ->pluck('is_active')
                ->first(),
            'instant' => InstantProgram::where('program', 'sedekah')
                ->first(),
        ];

        return view('admin.registration.index')->with([
            'datas' => $datas,
            'instant' => $istant,
        ]);
    }

    public function create()
    {
        $categories = ProjectCategory::all();

        return view('admin.registration.form')->with([
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {

        $cm = [];
        foreach($request->custom_nominal as $key => $value) {
            array_push($cm, $value == "" ? ($key + 1) * 50000 : $value);
        }
        $request->merge([
            'custom_nominal' => $cm,
        ]);

        $rules = [
            'title' => 'required|string|min:4',
            'content' => 'required|string|min:20',
            'category_id' => 'required',
            'featured' => 'nullable|max:5000|mimes:png,jpg,jpeg',
            'operational_percentage' => 'nullable|integer|max:100|min:0',
            'fundraiser_reward' =>'nullable|numeric|max:100|min:0',
        ];

        $is_unlimited = true;

        if (!$request->has('unlimited')) {
            $rules['nominal_target'] = 'required';
            $rules['date_target'] = 'required';
            $is_unlimited = false;
        }

        if (!$request->operational_percentage) {
            $request->merge([
                'operational_percentage' => 0,
            ]);
        }

        if ($request->slug == null) {
            $request->merge([
                'slug' => preg_replace('/[^a-zA-Z0-9_.-]/', '', str_replace(' ', '-', $request->title)),
            ]);
        }
        $rules['slug'] = 'required|unique:projects';

        $request->validate($rules);
        $filename = null;

        if ($request->hasFile('featured')) {
            $filename = $request->file('featured')->store('uploads/project');
        }

        $is_hidden = $request->is_hidden ? 1 : 0;

        Project::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'slug' => $request->slug,
            'path_featured' => $filename,
            'nominal_target' => ($is_unlimited) ? null : str_replace('.', '', $request->nominal_target),
            'date_target' => ($is_unlimited) ? null : Date('Y-m-d', strtotime($request->date_target)),
            'button_label' => $request->button_label,
            'operational_percentage' => $request->operational_percentage,
            'fundraiser_reward' => $request->fundraiser_reward,
            'custom_nominal' => json_encode($request->custom_nominal),
            'is_hidden' => !$is_hidden,
            'type' => 'registration',
        ]);

        return redirect('admin/pendaftaran')->with([
            'success' => 'Berhasil Menambahkan Penggalangan Dana',
        ]);
    }

    public function edit($id)
    {
        $data = Project::where('id', $id)
            ->first();
        if($data == null && $id == 0) {
            $instant = InstantProgram::where('program', 'sedekah')->first();
            $project = new Project();
            $project->id = 0;
            $project->title = $instant->title ?? "Program instant sedekah";
            $project->type = "sedekah";
            $project->is_hidden = $instant->is_active;
            $project->content = $instant->content;
            $project->button_label = $instant->label_button;
            $project->operational_percentage = $instant->operational;
            $project->fundraiser_reward = $instant->commision;
            $project->custom_nominal = $instant->custom_nominal;

            $data = $project;
        }else if($data == null && $id != 0) {
            abort(404);
        }

        $data->is_unlimited = false;

        if($data->custom_nominal == null) {
            $data->custom_nominal = [100000, 200000, 300000, 400000];
        }else{
            $data->custom_nominal = json_decode($data->custom_nominal);
        }

        if ($data->date_target == null && $data->nominal_target == null) {
            $data->is_unlimited = true;
            $data->date_target = null;
            $data->nominal_target = null;
        } else {
            $data->nominal_target = str_replace(',', '.', number_format($data->nominal_target));
            $data->date_target = Date('m/d/Y', strtotime($data->date_target));
        }
        $categories = ProjectCategory::all();
        return view('admin.registration.form')->with([
            'categories' => $categories,
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {

        if($id == 0){
            return $this->instantUpdate($request);
        }

        $cm = [];
        foreach($request->custom_nominal as $key => $value) {
            array_push($cm, $value == "" ? ($key + 1) * 50000 : $value);
        }
        $request->merge([
            'custom_nominal' => $cm,
        ]);

        $data = Project::where('id', $id)
            ->firstOrFail();

        $rules = [
            'title' => 'required|string|min:4',
            'content' => 'required|string|min:20',
            'category_id' => 'required',
            'featured' => 'nullable|max:5000|mimes:png,jpg,jpeg',
            'operational_percentage' => 'nullable|integer|max:100|min:0',
            'fundraiser_reward' =>'nullable|numeric|max:100|min:0',
        ];

        $is_unlimited = true;

        if (!$request->has('unlimited')) {
            $rules['nominal_target'] = 'required';
            $rules['date_target'] = 'required';
            $is_unlimited = false;
        }
        if ($request->slug == null) {
            $request->merge([
                'slug' => preg_replace('/[^a-zA-Z0-9_.-]/', '', str_replace(' ', '-', $request->title)),
            ]);
        }
        // $rules['slug'] = 'required|unique:projects';
        if (!$request->operational_percentage) {
            $request->merge([
                'operational_percentage' => 0,
            ]);
        }

        $request->validate($rules);

        if ($data->slug != $request->slug) {
            $request->validate([
                'slug' => 'unique:projects',
            ]);
        }

        $filename = $data->path_featured;

        if ($request->hasFile('featured')) {
            if ($data->path_featured != null) {
                Storage::delete($data->path_featured);
            }
            $filename = $request->file('featured')->store('uploads/project');
        }

        $is_hidden = $request->is_hidden ? 1 : 0;

        $data->update([
            'title' => $request->title,
            'content' => $request->content,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'path_featured' => $filename,
            'nominal_target' => ($is_unlimited) ? null : str_replace('.', '', $request->nominal_target),
            'date_target' => ($is_unlimited) ? null : Date('Y-m-d', strtotime($request->date_target)),
            'button_label' => $request->button_label,
            'operational_percentage' => $request->operational_percentage,
            'fundraiser_reward' => $request->fundraiser_reward,
            'custom_nominal' => json_encode($request->custom_nominal),
            'is_hidden' => !$is_hidden,
            'type' => 'registration',
        ]);

        return redirect('admin/pendaftaran')->with([
            'success' => 'Berhasil Mengedit Penggalangan Dana',
        ]);
    }
    public function destroy($id)
    {
        $data = Project::where('id', $id)
            ->firstOrFail();

        $data->update([
            'status' => 0
        ]);

        // if ($data->path_featured != null) {
        //     Storage::delete($data->path_featured);
        // }

        // $data->delete();

        return redirect('admin/pendaftaran')->with([
            'success' => 'Berhasil Menghapus Penggalangan Dana',
        ]);
    }
    public function all(Request $request) {
        $donation = Funding::when($request->q, function ($q) use ($request) {
            return $q->where('donature_name', 'LIKE', '%' . $request->q . '%');
        });

        if($request->gender != null) {
            $donation = $donation->where('jeniskelamin', $request->gender);
        }

           $donation = $donation->where('fund_type', 'registration')
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($donation as $key => $value) {
            if($value->project != null) {
                $value->project->title = $value->project->title;
            }else{
                $project = new Project();
                $project->id = 0;
                $project->type = $value->fund_type;
                $project->slug = "program-instant-".$value->fund_type;
                $project->title = "Program instant ".$value->fund_type;
                $project->percentage = 100;
                $project->button_label = $value->fund_type." sekarang";

                $value->project = $project;
            }
        }

        return view('admin.registrations.all')->with([
            'datas' => $donation,
        ]);
    }
    public function export()
    {
        $funding = Funding::orderBy('status', 'ASC')
        ->where('fund_type', 'registration')
            ->orderBy('created_at', 'DESC')
            ->get();

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="data_donasi_per_' . Date('dmYHis') . '.xls"');

        $data = [];
        $data[] = '#,Nama,Tgl Transaksi,Metode Pembayaran,Nominal,Status';

        echo "<table border=1>";

        echo "<thead>";
        echo "<tr>";
            echo "<th>No</th>";
            echo "<th>Campaign</th>";
            echo "<th>Nama</th>";
            echo "<th>Email</th>";
            echo "<th>No Telp</th>";
            echo "<th>Jenis Kelamin</th>";
            echo "<th>Alamat</th>";
            echo "<th>Program</th>";
            echo "<th>Usia</th>";
            echo "<th>Tanggal</th>";
            echo "<th>Metode Pembayaran</th>";
            echo "<th>Nominal</th>";
            echo "<th>Status</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        foreach ($funding as $key => $value) {
            if ($value->status == "paid") {
                $value->status = "sukses";
            } elseif (($value->status == "pending" && $value->time_limit > now()) || $value->status == "canceled") {
                $value->status = "gagal";
            }
            $date = date('d M Y', strtotime($value->created_at));
            $index = $key + 1;
            if($value->project != null) {
                $project_name = $value->project->title;
            }else{
                $project_name ="Program instant ".$value->fund_type;
            }

            echo "<tr>";
                echo "<td>".$index."</td>";
                echo "<td>".$project_name."</td>";
                echo "<td>".$value->donature_name."</td>";
                echo "<td>".$value->donature_email."</td>";
                echo "<td>".$value->donature_phone."</td>";
                echo "<td>".$value->jeniskelamin."</td>";
                echo "<td>".$value->kota."</td>";
                echo "<td>".$value->typeprogram."</td>";
                echo "<td>".$value->usia."</td>";
                echo "<td>".$date."</td>";
                echo "<td>".$value->payment_method."</td>";
                echo "<td>".$value->nominal."</td>";
                echo "<td>".$value->status."</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";

        // $fp = fopen('php://output', 'wb');
        // foreach ($data as $key => $line) {
        //     $val = explode(",", $line);
        //     fputcsv($fp, $val);
        // }
        // fclose($fp);
    }
}
