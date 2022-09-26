import BaseUrl from '../../helpers/BaseUrl.js';
import axiosIns from '../../libs/axios';

export async function save(context, data) {
	const url = BaseUrl.getUrl('api/orders');
	const request = await axiosIns.post(url, data);
	return request;
}
