export const generateErrors = (model: object, name: string | null = null) => {
  let errors: string[] = [];
  if (model) {
    model.$errors.forEach((item) => {
      let message = item.$message
        .replace("Value", name ? name : model.$path)
        .replace("metadata.", "")
        .replace(/[`~!@#$%^&*()_|+\-?;:'",\{\}\[\]\\\/]/gi, " ")
        .replace(".", "")
        .replace(new RegExp("\\b" + "id" + "\\b"), "") + '.';
      errors.push(_.capitalize(message));
    });
  }
  return errors;
}