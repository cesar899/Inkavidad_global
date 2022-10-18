import BaseUrl from '../../helpers/BaseUrl.js';
import axiosIns from '../../libs/axios';
import ToFormData from '../../helpers/ToFormData.js';

export async function save(context, data) {
	const formData = ToFormData.transform(data);
	const url = BaseUrl.getUrl('api/orders');
	const request = await axiosIns.post(url, formData);
	return request;
}
