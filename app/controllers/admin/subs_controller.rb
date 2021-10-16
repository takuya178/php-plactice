class Admin::SubsController < Admin::BaseController
  before_action :set_main, only: %i[show edit update destroy]

  def index
    @q = Sub.ransack(params[:q])
    @subs = @q.result.all
  end

  def new
    @sub = Sub.new
  end

  def create
    @sub = Sub.new(sub_params)

    if @sub.save
      redirect_to new_admin_sub_path, success: 'おつまみを追加しました'
    else
      flash.now[:danger] = 'おつまみを追加に失敗しました'
      render :new
    end
  end

  def edit; end

  def show; end

  def update
    if @sub.update(sub_params)
      redirect_to admin_sub_path(@sub), success: '更新に成功しました'
    else
      flash.now[:danger] = '更新に失敗しました'
      render :edit
    end
  end

  def destroy
    @sub.destroy!
    redirect_to admin_subs_path
  end

  private

  def sub_params
    params.require(:sub).permit(:name, :image, :calorie, :sugar, :lipid, :salt)
  end

  def set_main
    @sub = Sub.find(params[:id])
  end
end
