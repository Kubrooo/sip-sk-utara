/**
 * Dynamic Form Handler for SK Variable Input Fields
 */
export function dynamicFormHandler(initialFields = []) {
    return {
        fields: initialFields,
        addField() {
            this.fields.push({
                name: '',
                label: '',
                type: 'text',
                required: true
            });
        },
        removeField(index) {
            this.fields.splice(index, 1);
        }
    };
}
