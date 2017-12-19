package pojo;

import android.app.Activity;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.example.terminator.ngajarmysql.R;

import java.util.List;

/**
 * Created by Terminator on 17/12/2017.
 */

public class Adapter extends BaseAdapter {

    private Activity activity;
    private LayoutInflater inflater;
    private List<DataMhs> item;

    public Adapter(Activity activity, List<DataMhs> item) {
        this.activity = activity;
        this.item = item;
    }


    @Override
    public int getCount() {
        return item.size();
    }

    @Override
    public Object getItem(int location) {
        return item.get(location);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {

        if (inflater == null)
            inflater = (LayoutInflater) activity
                    .getSystemService(Context.LAYOUT_INFLATER_SERVICE);

        if (convertView == null)
            convertView = inflater.inflate(R.layout.list_mhs, null);


        TextView nama = (TextView) convertView.findViewById(R.id.nama);
        TextView npm = (TextView) convertView.findViewById(R.id.npm);
        TextView alamat = (TextView) convertView.findViewById(R.id.alamat);

        nama.setText(item.get(position).getNama());
        npm.setText(item.get(position).getNpm());
        alamat.setText(item.get(position).getAlamat());

        return convertView;
    }
}
