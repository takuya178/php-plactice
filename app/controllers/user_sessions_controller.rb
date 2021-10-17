class UserSessionsController < ApplicationController
  skip_before_action :require_login, only: %i[new create guest_login]

  def new; end

  def create
    @user = login(params[:email], params[:password])
    if @user
      redirect_back_or_to root_path, success: t('.success')
    else
      flash.now[:danger] = t('.fail')
      render :new
    end
  end

  def destroy
    logout
    flash[:success] = 'ログアウトしました'
    redirect_to root_path
  end

  def guest_login
    redirect_to root_path, alert: 'すでにログインしています' if current_user

    random_value = SecureRandom.hex
    user = User.create!(name: random_value, email: "test_#{random_value}@example.com", password: "#{random_value}", password_confirmation: "#{random_value}", role: :guest)
    auto_login(user)
    redirect_to select_food_combinations_path, notice: 'ゲストとしてログインしました'
  end
end
